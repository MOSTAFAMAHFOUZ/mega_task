<?php

namespace App\Imports;

use Throwable;
use App\Models\Task;
use App\Mail\TasksMail;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;



class TasksImport implements ToCollection, WithHeadingRow,WithChunkReading, ShouldQueue
{
    // use Queueable;
    private $tasks = [];
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        $this->validateRows($rows);


        // return ['Task Must Be unique'];
        try {
            \DB::beginTransaction();
            foreach ($rows as $row) {
                
                // check if the same task is existing or not 
                // if($this->checkIfTaskExist($row)){
                    Task::create([
                        'task_name' => $row['task_name'],
                        'employee_name' => $row['employee_name'],
                        'department' => $row['department'],
                        'branch' => $row['branch'],
                        'due_date' => date('Y-m-d',strtotime($row['due_date'])),
                        'priority' => $row['priority']]);
                // }else{
                //     session()->flash("error_import","Duplicated Data");
                //     \DB::rollback();
                //     return false;
                // }
            }
            \DB::commit();
            $this->sendEmail();
        } catch (Throwable $e) {
            \DB::rollback();
            session()->flash("error_db","Error In Inserting To Database");
        }
    }


    // sending email after inserting tasks in database
    public function sendEmail(){
        Mail::to("test@test.com")->send(new TasksMail());
    }


    public function chunkSize(): int
    {
        return 1000;
    }


    /**
     * check from all rows in the file
     * @param $rows 
     * @return validations 
     */

    public function validateRows($rows){
        Validator::make($rows->toArray(), [
            '*.task_name' => 'required',
            '*.employee_name' => 'required',
            '*.department' => 'required',
            '*.branch' => 'required',
            '*.due_date' => 'required',
            '*.priority' => 'required',
        ])->validated();
    }


    public function checkIfTaskExist($task){
        $key = str_replace(" ","",$task['task_name']."_".$task['employee_name']);
        if(array_key_exists($key,$this->tasks)){
            return false;
        }
        $this->tasks[$key] = $task;
        return true;
    }
}

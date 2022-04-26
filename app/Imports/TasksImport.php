<?php

namespace App\Imports;

use App\Models\Task;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Validator;

class TasksImport implements ToCollection, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            Task::create([
                'task_name' => $row['task_name'],
                'employee_name' => $row['employee_name'],
                'department' => $row['department'],
                'branch' => $row['branch'],
                'due_date' => date('Y-m-d',strtotime($row['due_date'])),
                'priority' => $row['priority']]);
        }
    }
}

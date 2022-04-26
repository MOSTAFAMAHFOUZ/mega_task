<?php 

namespace App\Services;
use Excel;
use App\Imports\TasksImport;

class TaskService{


    public function importTasksFromExcel($file){
        Excel::queueImport(new TasksImport,$file);
    }



}
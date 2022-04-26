<?php 

namespace App\Services;
use Excel;
use App\Imports\TasksImport;

class TaskService{


    public function importTasksFromExcel($file){
        Excel::import(new TasksImport,$file);
    }



}
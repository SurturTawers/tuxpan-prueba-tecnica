<?php

namespace App\Services;

use App\Models\Task;

class TaskServices {

    function getTask(){

    }

    function getTasks($active_only){
        $tasks = [];
        if($active_only) {
            $tasks = Task::where('is_active','=',true)->user();
        }else {
            $tasks = Task::all()->user();
        }
        return $tasks;
    }

    function createTask(){

    }

    function updateTask(){

    }

    function deleteTask(){

    }

}

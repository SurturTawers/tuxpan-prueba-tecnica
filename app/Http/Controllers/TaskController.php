<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\DeleteTaskRequest;
use App\Http\Requests\GetTasksRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Services\TaskServices;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    function getTasks(GetTasksRequest $getTasksRequest, TaskServices $taskServices){
        $active_only = $getTasksRequest->query('active');
        $tasks = $taskServices->getTasks($active_only ? $active_only : false);
        return response()->json($tasks,200);

    }

    function createTask(CreateTaskRequest $createTaskRequest, TaskServices $taskServices){

    }

    function updateTask(UpdateTaskRequest $updateTaskRequest, TaskServices $taskServices){

    }

    function deleteTask(DeleteTaskRequest $deleteTaskRequest, TaskServices $taskServices){

    }
}

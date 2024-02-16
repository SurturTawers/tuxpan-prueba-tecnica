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
        $task_data = $createTaskRequest->all();
        $response = $taskServices->createTask($task_data);
        if(!$response['success']) return response()->json(['success'=>$response['success'], 'error'=>$response['error']],500);
        return response()->json(['success'=>$response['success']],200);
    }

    function updateTask(UpdateTaskRequest $updateTaskRequest, TaskServices $taskServices){
        $task_id = $updateTaskRequest->route()->parameter('task_id');
        if(!$task_id) return response()->json(['success'=>false],400);

        $task_data = $updateTaskRequest->all();
        $response = $taskServices->updateTask($task_id, $task_data);
        if(!$response['success']) return response()->json(['success'=>$response['success'], 'error'=>$response['error']],500);
        return response()->json(['success'=>$response['success']],200);
    }

    function deleteTask(Request $request, TaskServices $taskServices){
        $task_id = $request->route()->parameter('task_id');
        if(!$task_id) return response()->json(['success'=>false, 'error'=> 'Falta task id'],400);

        $response = $taskServices->deleteTask($task_id);
        if(!$response['success']) return response()->json(['success'=>$response['success'], 'error'=>$response['error']],500);
        return response()->json(['success'=>$response['success']],200);
    }
}

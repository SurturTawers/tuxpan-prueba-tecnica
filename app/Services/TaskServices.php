<?php

namespace App\Services;

use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Database\QueryException;

class TaskServices {

    function getTasks($active_only){
        $tasks = [];
        if($active_only) {
            $tasks = Task::where('is_active',true)->with('users')->get();
        }else {
            $tasks = Task::with('users')->get();
        }
        return $tasks;
    }

    function createTask($task_data, $assigned_users){
        $new_task = Task::create($task_data);
        if(!isset($assigned_users)) return ['success'=>true,'error' => ''];
        try{
            $new_task->users()->syncWithPivotValues($assigned_users, ['assigned_at'=>Carbon::now()]);
        }catch(QueryException $e){
            return ['success'=>false,'error' => $e];
        }
        return ['success'=>true,'error' => ''];
    }

    function updateTask($task_id, $task_data){
        try{
            $updated_task = Task::find($task_id)->update($task_data);
        }catch(QueryException $e){
            return ['success'=>false,'error' => $e];
        }
        return ['success'=>true,'error' => ''];

    }

    function deleteTask($task_id){
        try{
            $deleted_task_id = Task::destroy($task_id);
        }catch(QueryException $e){
            return ['success'=>false,'error' => $e];
        }
        return ['success'=>true,'error' => ''];
    }

}

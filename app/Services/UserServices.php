<?php

namespace App\Services;

use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Database\QueryException;

class UserServices {

    function assignTaskToUsers($task_id, $users){
        $task = Task::find($task_id);
        try{
            $task->users()->syncWithPivotValues($users, ['assigned_at'=>Carbon::now()]);
        }catch(QueryException $e){
            return ['success'=>false,'error' => $e];
        }
        return ['success'=>true,'error' => ''];
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\AssignUsersRequest;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use App\Services\UserServices;
use Illuminate\Http\Request;

class UserController extends Controller
{

    function register(RegisterUserRequest $registerUserRequest){
        $user_data = $registerUserRequest->all();
        $new_user = User::create($user_data);

        $token = $new_user->createToken('API TOKEN')->plainTextToken;
        return response()->json(['api_token' => $token]);
    }


    function assignTask(AssignUsersRequest $assignUsersRequest, UserServices $userServices){
        $task_id =  $assignUsersRequest->route()->parameter('task_id');
        if(!$task_id) return response()->json(['success'=>false],400);
        $users = $assignUsersRequest->all();

        $response = $userServices->assignTaskToUsers($task_id, $users);
        if(!$response['success']) return response()->json(['success'=>$response['success'], 'error'=>$response['error']],500);
        return response()->json(['success'=>$response['success']],200);
    }
}

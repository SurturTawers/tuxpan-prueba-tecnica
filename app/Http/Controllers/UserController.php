<?php

namespace App\Http\Controllers;

use App\Http\Requests\AssignUsersRequest;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use App\Services\UserServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    function login(LoginUserRequest $loginUserRequest){
        $user = User::where('email',  $loginUserRequest->email)->first();
        if (!$user || ! Hash::check($loginUserRequest->password, $user->password)){
            return response()->json([
                'message' => ['Credenciales incorrectas'],
            ]);
        }

        $user->tokens()->delete();
        return response()->json([
            'success' => true,
            'token' => $user->createToken('API TOKEN')->plainTextToken,
        ]);
    }

    function register(RegisterUserRequest $registerUserRequest){
        $user_data = $registerUserRequest->all();
        $new_user = User::create([
            'email' => $user_data['email'],
            'password' => Hash::make($user_data['password']),
            'role' => $user_data['role']
        ]);

        $token = $new_user->createToken('API TOKEN')->plainTextToken;
        return response()->json(['token' => $token]);
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

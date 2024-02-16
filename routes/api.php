<?php

use Illuminate\Http\Request;
use \App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(TaskController::class)->prefix('tasks')->group(function(){
    Route::get('','getTasks');
    Route::post('','createTask');
    Route::put('/{task_id}','updateTask');
    Route::delete('/{task_id}','deleteTask');
});


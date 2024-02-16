<?php

use Illuminate\Http\Request;
use \App\Http\Controllers\TaskController;
use \App\Http\Controllers\UserController;
use \App\Http\Middleware\isAdmin;
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

/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/

Route::controller(TaskController::class)->prefix('tasks')->group(function(){
    Route::get('','getTasks')->middleware('auth:sanctum');;
    Route::post('','createTask')->middleware(['auth:sanctum',isAdmin::class]);;
    Route::put('/{task_id}','updateTask')->middleware(['auth:sanctum',isAdmin::class]);;
    Route::delete('/{task_id}','deleteTask')->middleware(['auth:sanctum',isAdmin::class]);;
});

Route::controller(UserController::class)->prefix('user')->group(function () {
    Route::post('login','login');
    Route::post('/register', 'register');
    Route::post('/task/{task_id}', 'assignTask')->middleware(['auth:sanctum',isAdmin::class]);
});

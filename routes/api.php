<?php

use App\Http\Controllers\API\V1\Auth\LoginController;
use App\Http\Controllers\API\V1\Auth\RegisterController;
use App\Http\Controllers\API\V1\Task\TaskController;
use App\Http\Controllers\API\V1\User\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('auth/login', [LoginController::class, 'login']);
Route::post('auth/register', [RegisterController::class, 'register']);

Route::group(['middleware' => ['jwt.verify']], function () {

    // Task Route
    Route::apiResource('tasks', TaskController::class);

    //User Profile Route
    Route::post('users/profile', [UserController::class, 'getUserByToken']);
});


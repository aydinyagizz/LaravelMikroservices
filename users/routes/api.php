<?php

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

Route::post('register', [\App\Http\Controllers\AuthController::class, 'register']);
Route::post('login', [\App\Http\Controllers\AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [\App\Http\Controllers\AuthController::class, 'logout']);
    Route::get('user', [\App\Http\Controllers\AuthController::class, 'user']);
    Route::put('user/info', [\App\Http\Controllers\AuthController::class, 'updateInfo']);
    Route::put('user/password', [\App\Http\Controllers\AuthController::class, 'updatePassword']);
});

Route::get('users', [\App\Http\Controllers\UserController::class, 'index']);
Route::get('users/{id}', [\App\Http\Controllers\UserController::class, 'show']);


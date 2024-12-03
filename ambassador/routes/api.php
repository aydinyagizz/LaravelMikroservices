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

Route::prefix('ambassador')->group(function () {
//    function common(string $scope)
//    {
    Route::post('register', [\App\Http\Controllers\AuthController::class, 'register']);
    Route::post('login', [\App\Http\Controllers\AuthController::class, 'login']);

    Route::get('products/frontend', [\App\Http\Controllers\ProductController::class, 'frontend']);
    Route::get('products/backend', [\App\Http\Controllers\ProductController::class, 'backend']);

    Route::middleware('scope.ambassador')->group(function () {
        Route::get('user', [\App\Http\Controllers\AuthController::class, 'user']);
        Route::post('logout', [\App\Http\Controllers\AuthController::class, 'logout']);
        Route::put('users/info', [\App\Http\Controllers\AuthController::class, 'updateInfo']);
        Route::put('users/password', [\App\Http\Controllers\AuthController::class, 'updatePassword']);

        Route::post('links', [\App\Http\Controllers\LinkController::class, 'store']);
        Route::get('stats', [\App\Http\Controllers\StatsController::class, 'index']);
        Route::get('rankings', [\App\Http\Controllers\StatsController::class, 'rankings']);
//    }
    });
});

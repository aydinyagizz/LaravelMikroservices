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

Route::prefix('checkout')->group(function () {
    Route::get('links/{code}', [App\Http\Controllers\LinkController::class, 'show']);
    Route::post('orders', [App\Http\Controllers\OrderController::class, 'store']);
    Route::post('order/confirm', [App\Http\Controllers\OrderController::class, 'confirm']);
});


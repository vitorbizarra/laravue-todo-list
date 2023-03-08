<?php

use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::post('/login', [App\Http\Controllers\AuthController::class, 'login']);

    Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout']);

    Route::post('/register', [App\Http\Controllers\AuthController::class, 'register']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::apiResource('tasks', \App\Http\Controllers\TaskController::class);
    });
});

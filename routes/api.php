<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Public routes (no auth required)
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

// Protected routes (require token)
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('logout', [AuthController::class, 'logout']);

    Route::apiResource('profiles', \App\Http\Controllers\ProfileController::class);
    Route::apiResource('posts', \App\Http\Controllers\PostController::class);
    Route::apiResource('categories', \App\Http\Controllers\CategoryController::class);
    Route::apiResource('users', \App\Http\Controllers\UserController::class);
    Route::apiResource('orders', \App\Http\Controllers\OrderController::class);
    Route::apiResource('products', \App\Http\Controllers\ProductController::class);
});

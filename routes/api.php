<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('profiles', \App\Http\Controllers\ProfileController::class);
Route::apiResource('posts', \App\Http\Controllers\PostController::class);
Route::apiResource('categories', \App\Http\Controllers\CategoryController::class);
Route::apiResource('users', \App\Http\Controllers\UserController::class);   
Route::apiResource('orders', \App\Http\Controllers\OrderController::class);
Route::apiResource('products', \App\Http\Controllers\ProductController::class);
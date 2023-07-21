<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::apiResource('users', UserController::class);
Route::apiResource('cats', CategoryController::class);
Route::apiResource('tags', TagController::class);
Route::apiResource('posts', PostController::class);
Route::post('login', [AuthController::class, 'login']);

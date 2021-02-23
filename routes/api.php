<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserPostController;


Route::middleware('auth:api')->group(function(){
    // Route::apiResource('posts', PostController::class);
    // Route::apiResource('users', UserController::class);
    Route::apiResources([
        'posts'=>PostController::class,
        'users'=> UserController::class,
        'users/{user}/posts'=>UserPostController::class
    ]);

});
// Route::get('/posts', [PostController::class, 'index']);
// Route::post('/posts', [PostController::class, 'store']);






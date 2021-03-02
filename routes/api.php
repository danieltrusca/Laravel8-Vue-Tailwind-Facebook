<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostLikeController;
use App\Http\Controllers\PostCommentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserPostController;
use App\Http\Controllers\UserImageController;
use App\Http\Controllers\AuthUserController;
use App\Http\Controllers\FriendRequestController;
use App\Http\Controllers\FriendRequestResponseController;


Route::middleware('auth:api')->group(function(){
    // Route::apiResource('posts', PostController::class);
    // Route::apiResource('users', UserController::class);
    Route::get('/auth-user', [AuthUserController::class, 'show']);
    Route::apiResources([
        'posts'=>PostController::class,
        'posts/{post}/like'=>PostLikeController::class,
        'posts/{post}/comment'=>PostCommentController::class,
        'users'=> UserController::class,
        'users/{user}/posts'=>UserPostController::class,
        'friend-request'=>FriendRequestController::class,
        'friend-request-response'=>FriendRequestResponseController::class,
        'user-images'=>UserImageController::class
    ]);

});
// Route::get('/posts', [PostController::class, 'index']);
// Route::post('/posts', [PostController::class, 'store']);






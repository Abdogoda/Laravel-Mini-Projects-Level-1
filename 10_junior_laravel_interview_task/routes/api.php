<?php

use App\Http\Controllers\Api\V1\Auth\LoginController;
use App\Http\Controllers\Api\V1\Auth\RegisterController;
use App\Http\Controllers\Api\V1\Auth\VerificationController;
use App\Http\Controllers\Api\V1\PostController;
use App\Http\Controllers\Api\V1\StatsController;
use App\Http\Controllers\Api\V1\TagController;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return new UserResource($request->user());
})->middleware('auth:sanctum');

Route::post('register', RegisterController::class);
Route::post('verify', VerificationController::class);
Route::post('login', LoginController::class);

Route::get("stats", StatsController::class);

Route::middleware('auth:sanctum')->group(function(){
    Route::apiResource('tags', TagController::class)->except(['show']);
    
    Route::get('posts/deleted', [PostController::class, 'deleted']);
    Route::post('posts/{post}/restore', [PostController::class, 'restore']);
    Route::apiResource('posts', PostController::class);
});
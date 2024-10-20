<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\LogoutController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\BrandController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/login', LoginController::class);
Route::post('/register', RegisterController::class);


// Authenticated Routes
Route::middleware('auth:sanctum')->group(function(){
    Route::post('/logout', LogoutController::class);

    Route::get('/user', function (Request $request) {
        $user = User::with('products')->find($request->user()->id);
        return new UserResource($user);
    });

    Route::apiResource('brands', BrandController::class);
    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('products', ProductController::class);
});
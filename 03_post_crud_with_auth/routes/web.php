<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use PHPUnit\Metadata\PostCondition;

Route::get('/', function () {
    return view('welcome');
});

Route::view("login", "auth.login")->name('login');
Route::view("register", "auth.register")->name('register');

Route::post('register', RegisterController::class)->name('register.store');
Route::post('login', LoginController::class)->name('login.store');

Route::middleware('auth')->group(function(){
    Route::get("profile", ProfileController::class)->name('profile');
    Route::post('logout', LogoutController::class)->name('logout');

    Route::resource('posts', PostController::class)->except(['index']);
});

Route::get("posts", [PostController::class, 'index'])->name("posts.index");
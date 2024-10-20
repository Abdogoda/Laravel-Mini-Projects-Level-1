<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::view("login", "auth.login")->name('login');
Route::view("register", "auth.register")->name('register');

Route::post('register', RegisterController::class)->name('register.store');
Route::post('login', LoginController::class)->name('login.store');

Route::middleware('auth')->group(function(){
    Route::view("dashboard", "dashboard")->name('dashboard');
    Route::post('logout', LogoutController::class)->name('logout');
});
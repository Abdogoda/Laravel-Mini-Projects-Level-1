<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

    Route::get("user-route", function(){return "You are in the user route";})->middleware('user');
    Route::get("teacher-route", function(){return "You are in the teacher route";})->middleware('teacher');
});
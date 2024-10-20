<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\PasswordForgotController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::view("login", "auth.login")->name('login');
Route::view("register", "auth.register")->name('register');

Route::post('register', RegisterController::class)->name('register.store');
Route::post('login', LoginController::class)->name('login.store');

Route::get("/forgot-password", [PasswordForgotController::class, 'forgotForm']);
Route::post("/forgot-password", [PasswordForgotController::class, 'forgot']);

Route::get("/reset-password/{token}/{email}", [PasswordResetController::class, 'resetForm']);
Route::post("/reset-password", [PasswordResetController::class, 'reset']);

Route::middleware('auth')->group(function(){
    Route::view("profile", "profile")->name('profile');
    Route::post("profile", [ProfileController::class, 'update'])->name('profile.update');
    Route::post("profile/change-password", [ProfileController::class, 'changePassword'])->name('profile.change-password');
    
    Route::post('logout', LogoutController::class)->name('logout');
});
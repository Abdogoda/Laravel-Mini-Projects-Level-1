<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
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

    Route::controller(UserController::class)->prefix('users')->name('users.')->group(function(){
        Route::get("/", 'index')->name('index')->middleware('hasPermission:view_users');
        Route::get("/create", 'create')->name('create')->middleware('hasPermission:create_user');
        Route::post("/", 'store')->name('store')->middleware('hasPermission:create_user');
        Route::get("/{user}/edit", 'edit')->name('edit')->middleware('hasPermission:edit_user');
        Route::put("/{user}", 'update')->name('update')->middleware('hasPermission:edit_user');
        Route::delete("/{user}", 'destroy')->name('destroy')->middleware('hasPermission:delete_user');
    });

    Route::controller(RoleController::class)->prefix('roles')->name('roles.')->group(function(){
        Route::get("/", 'index')->name('index')->middleware('hasPermission:view_roles');
        Route::get("/create", 'create')->name('create')->middleware('hasPermission:create_role');
        Route::post("/", 'store')->name('store')->middleware('hasPermission:create_role');
        Route::get("/{role}/edit", 'edit')->name('edit')->middleware('hasPermission:update_role');
        Route::put("/{role}", 'update')->name('update')->middleware('hasPermission:update_role');
        Route::delete("/{role}", 'destroy')->name('destroy')->middleware('hasPermission:delete_role');
    });
    
    // Route::resource('users', UserController::class)->except(['show']);
    // Route::resource('roles', RoleController::class)->except(['show']);
});
<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('tasks', TaskController::class);
Route::post("tasks/{task}/force-delete", [TaskController::class, 'forceDelete'])->name('tasks.force-delete');
Route::post("tasks/{task}/restore", [TaskController::class, 'restore'])->name('tasks.restore');
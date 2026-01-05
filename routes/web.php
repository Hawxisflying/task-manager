<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/tasks');
});

Route::resource('tasks', TaskController::class);

/* 👇 ADD THIS LINE BELOW resource */
Route::patch('/tasks/{task}/toggle', [TaskController::class, 'toggleStatus'])
    ->name('tasks.toggle');

<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\TaskController;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

// Route::get('dashboard',[taskController::class,'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('dashboard', [TaskController::class,'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::post('/task', [TaskController::class,'store'])->middleware(['auth', 'verified'])->name('task.store');
Route::patch('/tasks/{task}', [TaskController::class, 'update'])->middleware(['auth', 'verified'])->name('task.update');
Route::delete('/task/{task}/remove', [TaskController::class,'remove'])->middleware(['auth', 'verified'])->name('task.remove');
Route::patch('/task/{task}/toggle_completed', [TaskController::class, 'toggleCompleted'])->middleware(['auth', 'verified'])->name('task.toggle_completed');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';

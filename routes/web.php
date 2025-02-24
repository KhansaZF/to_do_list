<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ToDoController;
use App\Models\ToDo;

Route::get('/todos',
[ToDoController::class, 'index'])->name('todos.index');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    

    Route::get('/todo', [ToDoController::class, 'index'])->name('todo.index');
    Route::get('/todos/create', [ToDoController::class, 'create'])->name('todo.create');
    Route::post('/todo', [ToDoController::class, 'store'])->name('todos.store');
    Route::get('/todo/{id}/edit', [ToDoController::class, 'edit']);
    Route::patch('/todo/{id}', [ToDoController::class, 'update']);
    Route::delete('/todo/{id}', [ToDoController::class, 'destroy']);
    Route::get('/todo/{id}', [ToDoController::class, 'show'])->name('todo.show');
    Route::get('/', [ToDoController::class, 'completedTodos'])->name('home');
});

require __DIR__.'/auth.php';

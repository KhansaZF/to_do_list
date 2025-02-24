<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ToDoController;
use Illuminate\Support\Facades\Route;

// Halaman Home (Dapat diakses tanpa login)
Route::get('/', [ToDoController::class, 'home'])->name('home');

// Halaman Welcome (jika masih ingin dipakai)
Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

// Halaman Dashboard (Hanya bisa diakses jika login)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Semua Route yang membutuhkan login
Route::middleware(['auth'])->group(function () {
    // Profil User
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // To-Do List (CRUD)
    Route::get('/todo', [ToDoController::class, 'index'])->name('todo.index');
    Route::get('/todos/create', [ToDoController::class, 'create'])->name('todo.create');
    Route::post('/todo', [ToDoController::class, 'store'])->name('todos.store');
    Route::get('/todo/{id}/edit', [ToDoController::class, 'edit'])->name('todo.edit');
    Route::patch('/todo/{id}', [ToDoController::class, 'update'])->name('todo.update');
    Route::delete('/todo/{id}', [ToDoController::class, 'destroy'])->name('todo.destroy');
    Route::get('/todo/{id}', [ToDoController::class, 'show'])->name('todo.show');
});

// Mengimpor file auth untuk authentication routes (login, register, dll.)
require __DIR__.'/auth.php';

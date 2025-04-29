<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/cadastrar', [AuthController::class, 'registerForm'])->name('register.form');
    Route::post('/cadastrar', [AuthController::class, 'register'])->name('register');
    Route::get('/login', [AuthController::class, 'loginForm'])->name('login.form');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/', [TaskController::class, 'index'])->name('home');
    Route::get('/alterar-status/{task}', [TaskController::class, 'toggleStatus'])->name('toggle.status');
});

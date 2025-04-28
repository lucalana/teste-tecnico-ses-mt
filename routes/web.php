<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/cadastrar', [AuthController::class, 'registerForm'])->name('register.form');
    Route::post('/cadastrar', [AuthController::class, 'register'])->name('register');
});

Route::middleware('auth')->group(function () {
    Route::get('/', fn() => 'Teste')->name('home');
});

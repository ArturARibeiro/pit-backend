<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    echo "Logado? " . (\Illuminate\Support\Facades\Auth::check() ? "Sim" : "Nao");
});

Route::group(['as' => 'auth.'], function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/sign-in', [AuthController::class, 'signIn'])->name('sign-in');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/attempt', [AuthController::class, 'attempt'])->name('attempt');

    Route::group(['middleware' => 'auth'], function () {
        Route::get('/sid', [AuthController::class, 'sid'])->name('sid');
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    });
});

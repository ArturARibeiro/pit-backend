<?php

use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth:api', 'as' => 'user.', 'prefix' => 'users'], function () {
    Route::get('/{user}', [UserController::class, 'show'])->name('show');
});

Route::group(['as' => 'product.', 'prefix' => 'products'], function () {
    Route::get('/', [ProductController::class, 'index'])->name('index');
    Route::get('/{product}', [ProductController::class, 'show'])->name('show');
});

Route::group(['middleware' => 'auth:api', 'as' => 'order.', 'prefix' => 'orders'], function () {
    Route::get('/', [OrderController::class, 'index'])->name('index');
    Route::post('/', [OrderController::class, 'store'])->name('store');
    Route::get('/{order}', [OrderController::class, 'show'])->name('show');
    Route::put('/{order}', [OrderController::class, 'rate'])->name('rate');
});

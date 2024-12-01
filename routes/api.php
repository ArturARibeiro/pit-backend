<?php

use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\Api\CardController;
use App\Http\Controllers\Api\CategoryController;
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

Route::group(['as' => 'category.', 'prefix' => 'categories'], function () {
    Route::get('/', [CategoryController::class, 'index'])->name('index');
    Route::get('/{category:slug}', [CategoryController::class, 'show'])->name('show');
});

Route::group(['middleware' => 'auth:api', 'as' => 'order.', 'prefix' => 'orders'], function () {
    Route::get('/', [OrderController::class, 'index'])->name('index');
    Route::post('/', [OrderController::class, 'store'])->name('store');
    Route::get('/{order}', [OrderController::class, 'show'])->name('show');
    Route::post('/{order}/rate', [OrderController::class, 'rate'])->name('rate');
    Route::post('/{order}/finish', [OrderController::class, 'finish'])->name('finish');
    Route::post('/{order}/cancel', [OrderController::class, 'cancel'])->name('cancel');
});

Route::group(['middleware' => 'auth:api', 'as' => 'address.', 'prefix' => 'addresses'], function () {
    Route::post('/', [AddressController::class, 'store'])->name('store');
    Route::get('/{address}', [AddressController::class, 'show'])->name('show');
});

Route::group(['middleware' => 'auth:api', 'as' => 'card.', 'prefix' => 'cards'], function () {
    Route::post('/', [CardController::class, 'store'])->name('store');
});

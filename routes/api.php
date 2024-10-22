<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Support\Facades\Route;


Route::middleware('isTrust')->group(function () {

    Route::prefix('auth')->controller(AuthController::class)->group(function () {

        Route::post('login', 'login')->middleware('throttle:3,1');

    });

    Route::middleware(['auth:sanctum', 'isVerified'])->group(function () {

        Route::prefix('products')->controller(ProductController::class)->group(function () {

            Route::get('/', 'index')->middleware('throttle:60,1');

        });

        Route::prefix('orders')->controller(OrderController::class)->group(function () {

            Route::post('/', 'store')->middleware('throttle:60,1');

            Route::get('{id}', 'show')->middleware('throttle:60,1');

        });

    });

});

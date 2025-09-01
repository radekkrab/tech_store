<?php

use Illuminate\Support\Facades\Route;




Route::apiResource('products', App\Http\Controllers\ProductController::class);

Route::apiResource('categories', App\Http\Controllers\CategoryController::class);

Route::apiResource('orders', App\Http\Controllers\OrderController::class);

Route::apiResource('tags', App\Http\Controllers\TagController::class);

Route::apiResource('balances', App\Http\Controllers\BalanceController::class);

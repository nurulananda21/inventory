<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CategoryController;

// Public Routes
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

// Protected Routes
Route::middleware('auth:sanctum')->group(function () {

    // Categories
    Route::apiResource('categories', CategoryController::class)
        ->except(['destroy']);

    Route::delete('categories/{category}', [CategoryController::class, 'destroy'])
        ->middleware('role:admin');

    // Items
    Route::apiResource('items', ItemController::class)
        ->except(['destroy']);

    Route::delete('items/{item}', [ItemController::class, 'destroy'])
        ->middleware('role:admin');
});
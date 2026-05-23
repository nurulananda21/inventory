<?php

use Illuminate\Support\Facades\Route;

Route::post('/items', function () {
    return response()->json([
        'status' => 'success'
    ]);
});
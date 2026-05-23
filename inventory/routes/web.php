<?php

use Illuminate\Support\Facades\Route;

Route::post('/items', function () {
    return [
        'status' => 'success'
    ];
});
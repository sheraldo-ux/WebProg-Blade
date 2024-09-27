<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcomes');
});

Route::get('/about', function () {
    return view('welcome');
});


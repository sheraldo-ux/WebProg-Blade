<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('animation');
});

Route::get('/map', function () {
    return view('main');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/information', function () {
    return view('information');
});

Route::get('/tips', function () {
    return view('tips');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/support', function () {
    return view('support');
});

Route::get('/tesloc', function () {
    return view('tesloc');
});
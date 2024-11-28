<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FloodLocationController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\UserController;

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

Route::get('/flood-locations', [FloodLocationController::class, 'index']);

Route::get('/tesloc', function() {
    return view('tesloc');
});

Route::get('/login', [UserController::class, 'showLogin'])->name('view_login');
Route::post('/login', [UserController::class, 'login'])->name('login');
Route::get('/register', [UserController::class, 'showRegister'])->name('view_register');
Route::post('/register', [UserController::class, 'register'])->name('register');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::post('/news', [NewsController::class, 'store'])->name('news.store')->middleware('auth');

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

Route::get('/support', function () {
    return view('support');
});

Route::get('/flood-locations', [FloodLocationController::class, 'index']);

Route::get('/tesloc', function() {
    return view('tesloc');
});

// Auth Routes
Route::get('/login', [UserController::class, 'showLogin'])->name('view_login');
Route::post('/login', [UserController::class, 'login'])->name('login');
Route::get('/register', [UserController::class, 'showRegister'])->name('view_register');
Route::post('/register', [UserController::class, 'register'])->name('register');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

// Account Routes
Route::get('/account', function () {
    return view('account');
})->name('account')->middleware('auth');

Route::post('/profile/update-photo', [UserController::class, 'updateProfilePhoto'])
    ->middleware('auth')
    ->name('updateProfilePhoto');

// News Routes
Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::post('/news', [NewsController::class, 'store'])->name('news.store')->middleware('auth');
Route::resource('news', NewsController::class)->middleware('auth');

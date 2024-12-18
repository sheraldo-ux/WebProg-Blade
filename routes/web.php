<?php

use App\Http\Controllers\AboutController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FloodLocationController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\User\AdminController;
use App\Http\Controllers\User\ContributorController;
use App\Http\Controllers\User\ReporterController;
use App\Http\Controllers\User\UserController;
use App\Models\User;

Route::get('/', function () {
    // return view('animation');
    return redirect()->route('map');

});

Route::get('/map', function () {
    return view('main');
})->name('map');

Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::post('/about', [AboutController::class, 'submit'])->name('submit_feedback');

Route::get('/information', function () {
    return view('information');
})->name('information');

Route::get('/tips', function () {
    return view('tips');
})->name('tips');

Route::get('/support', function () {
    return view('support');
})->name('support');

// fetch flood data to map
Route::get('/flood-locations', [FloodLocationController::class, 'getFloodLocations']);
Route::get('/city-details', [FloodLocationController::class, 'getCityDetails']);

// submit report 
Route::post('/submitReport', [ReportController::class, 'store']);

Route::get('/tesloc', function() {
    return view('tesloc');
})->name('tesloc');

// Auth Routes
Route::get('/login', [UserController::class, 'showLogin'])->name('view_login');
Route::post('/login', [UserController::class, 'login'])->name('login');
Route::get('/register', [UserController::class, 'showRegister'])->name('view_register');
Route::post('/register', [UserController::class, 'register'])->name('register');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

// Account Routes
// Route::get('/account', function () {
//     return view('account');
// })->name('account')->middleware('auth');

Route::prefix('profile')->name('profile.')->middleware('auth')->group(function () {
    Route::get('/', [UserController::class, 'showProfile'])->name('show_profile');
    Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin,superadmin'])->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('index');
        Route::get('/feedback', [AdminController::class, 'view_feedback'])->name('view_feedback');
        Route::get('/create', [AdminController::class, 'view_create'])->name('view_create');
        Route::post('/create', [AdminController::class, 'create'])->name('create');
        Route::get('/{id}/update', [AdminController::class, 'view_update'])->name('view_update');
        Route::put('/{id}/update', [AdminController::class, 'update'])->name('update');
        Route::get('/user-report', [AdminController::class, 'view_user_report'])->name('view_user_report');
        Route::delete('/delete-user/{id}', [AdminController::class, 'delete_user'])->name('delete_user');
    });
    // Route::prefix('reporter')->name('reporter.')->middleware(['auth', 'role:reporter'])->group(function () {
    //     Route::get('/', [ReporterController::class, 'index'])->name('index');
    // });
    // Route::prefix('contributor')->name('contributor.')->middleware(['auth', 'role:contributor'])->group(function () {
    //     Route::get('/', [ContributorController::class, 'index'])->name('index');
    // });
});

Route::post('/profile/update-photo', [UserController::class, 'updateProfilePhoto'])
    ->middleware('auth')
    ->name('updateProfilePhoto');

// News Routes
Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::post('/news', [NewsController::class, 'store'])->name('news.store')->middleware('auth');
Route::resource('news', NewsController::class)->middleware('auth');

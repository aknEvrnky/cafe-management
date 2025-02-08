<?php

use App\Http\Controllers\Panel\AuthController;
use App\Http\Controllers\Panel\CafeController;
use App\Http\Controllers\Panel\DashboardController;
use App\Http\Controllers\Panel\RegisterController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::prefix('dashboard')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/', DashboardController::class)->name('dashboard');
    Route::get('/cafes/create', [CafeController::class, 'create'])->name('cafes.create');
    Route::post('/cafes', [CafeController::class, 'store'])->name('cafes.store');
    Route::post('/cafes/unique-slug', [CafeController::class, 'uniqueSlug'])->name('cafes.unique-slug');
    Route::put('/cafes/switch', [CafeController::class, 'switchCafe'])->name('cafes.switch');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'create')->name('login')->middleware(['guest']);
    Route::post('/login', 'store')->name('login')->middleware(['guest']);
    Route::post('/logout', 'destroy')->name('logout')->middleware(['auth']);
});

Route::get('/register', [RegisterController::class, 'create'])->name('register')->middleware(['guest']);
Route::post('/register', [RegisterController::class, 'store'])->name('register')->middleware(['guest']);

<?php

use App\Http\Controllers\Panel\AuthController;
use App\Http\Controllers\Panel\CafeController;
use App\Http\Controllers\Front\CafeController as FrontCafeController;
use App\Http\Controllers\Front\ProductCategoryController as FrontProductCategoryController;
use App\Http\Controllers\Panel\DashboardController;
use App\Http\Controllers\Panel\ProductCategoryController;
use App\Http\Controllers\Panel\ProductController;
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
    Route::get('/cafes/edit-current-cafe', [CafeController::class, 'editCurrentCafe'])->name('cafes.edit-current-cafe');
    Route::post('/cafes/update-current-cafe', [CafeController::class, 'updateCurrentCafe'])->name('cafes.update-current-cafe');

    Route::get('/product-categories', [ProductCategoryController::class, 'index'])->name('product-categories.index');
    Route::get('/product-categories/create', [ProductCategoryController::class, 'create'])->name('product-categories.create');
    Route::post('/product-categories', [ProductCategoryController::class, 'store'])->name('product-categories.store');
    Route::get('/product-categories/{productCategory}/edit', [ProductCategoryController::class, 'edit'])->name('product-categories.edit');
    Route::put('/product-categories/{productCategory}', [ProductCategoryController::class, 'update'])->name('product-categories.update');
    Route::delete('/product-categories/{productCategory}', [ProductCategoryController::class, 'destroy'])->name('product-categories.destroy');

    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::patch('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'create')->name('login')->middleware(['guest']);
    Route::post('/login', 'store')->name('login')->middleware(['guest']);
    Route::post('/logout', 'destroy')->name('logout')->middleware(['auth']);
});

Route::get('/register', [RegisterController::class, 'create'])->name('register')->middleware(['guest']);
Route::post('/register', [RegisterController::class, 'store'])->name('register')->middleware(['guest']);

Route::get('/{cafe:slug}', FrontCafeController::class)->name('cafes.view');
Route::get('/{cafe:slug}/product-categories/{productCategory:slug}', FrontProductCategoryController::class)->name('product-categories.view');

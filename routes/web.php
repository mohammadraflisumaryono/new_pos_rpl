<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Middleware\SuperAdmin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DiscountProductController;
use App\Http\Controllers\SliderController;

// Resource routes for products and categories
Route::resource('products', ProductController::class)->except(['show']);
Route::get('products/display', [ProductController::class, 'display'])->name('products.display');
Route::get('products/{product}', [ProductController::class, 'show'])->name('products.show');
Route::resource('categories', CategoryController::class);



Route::resource('sliders', SliderController::class);



// Route::get('/discount-products', [DiscountProductController::class, 'index']);


// Grouped routes for menus with a prefix
Route::prefix('menus')->group(function () {
    Route::get('/index', [MenuController::class, 'index'])->name('menus.index');
    Route::get('/create', [MenuController::class, 'create'])->name('menus.create');
    Route::post('/', [MenuController::class, 'store'])->name('menus.store');
    Route::get('/{menu}/edit', [MenuController::class, 'edit'])->name('menus.edit');
    Route::put('/{menu}', [MenuController::class, 'update'])->name('menus.update');
    Route::delete('/{menu}', [MenuController::class, 'destroy'])->name('menus.destroy');
})->middleware(['auth', 'verified']);

Route::prefix('superadmin')->group(function () {
    Route::get('/', [SuperAdmin::class, 'index'])->name('superadmin.index');
})->middleware(['auth', 'verified', 'superadmin']);

// Dashboard route
Route::get('/', [HomeController::class, 'index'])
    ->name('dashboard');

// Grouped routes for profile with authentication middleware
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Authentication routes
require __DIR__ . '/auth.php';

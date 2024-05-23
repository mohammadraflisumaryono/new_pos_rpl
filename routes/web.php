<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::resource('products', ProductController::class);
Route::resource('categories', CategoryController::class);

Route::prefix('menus')->group(function () {
    Route::get('/', [MenuController::class, 'index'])->name('menus.index');
    Route::get('/index', [MenuController::class, 'index'])->name('menus.index');
    Route::get('/create', [MenuController::class, 'create'])->name('menus.create');
    Route::post('/', [MenuController::class, 'store'])->name('menus.store');
    Route::get('/{menu}/edit', [MenuController::class, 'edit'])->name('menus.edit');
    Route::put('/{menu}', [MenuController::class, 'update'])->name('menus.update');
    Route::delete('/{menu}', [MenuController::class, 'destroy'])->name('menus.destroy');
});

Route::get('/dashboard', [HomeController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

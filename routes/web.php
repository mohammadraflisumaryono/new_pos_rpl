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
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DiscountProductController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;

// Authentication routes
require __DIR__ . '/auth.php';

// Resource routes for products and categories
Route::prefix('categories')->group(function () {
    Route::get('/index', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
})->middleware(['auth', 'verified', 'superadmin']);

Route::prefix('products')->group(function () {
    Route::get('/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/', [ProductController::class, 'store'])->name('products.store');
    Route::get('/', [ProductController::class, 'index'])->name('products.index');
    Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/{product}', [ProductController::class, 'update'])->name('products.update');

    Route::get('/display', [ProductController::class, 'display'])->name('products.display');
    Route::get('/{product}', [ProductController::class, 'show'])->name('products.show');
    Route::get('/addstock', [ProductController::class, 'addstock'])->name('products.addstock');
    Route::delete('/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
    Route::get('/display', [ProductController::class, 'display'])->name('products.display');
    Route::get('/{product}/show', [ProductController::class, 'show'])->name('products.show');
})->middleware(['auth', 'verified', 'superadmin', 'manager']);

// routes/web.php

Route::post('/product/info', [ProductController::class, 'getProductInfo'])->name('product.info');
Route::post('/products/updatestock', [ProductController::class, 'updatestock'])->name('products.updatestock');




Route::resource('sliders', SliderController::class);

Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
    Route::delete('/cart/{cart}', [CartController::class, 'destroy'])->name('cart.destroy');
    Route::put('/cart/{cart}', [CartController::class, 'update'])->name('cart.update');
});




// Route::get('/discount-products', [DiscountProductController::class, 'index']);



// Grouped routes for menus with a prefix
Route::prefix('menus')->group(function () {
    Route::get('/index', [MenuController::class, 'index'])->name('menus.index');
    Route::get('/create', [MenuController::class, 'create'])->name('menus.create');
    Route::post('/', [MenuController::class, 'store'])->name('menus.store');
    Route::get('/{menu}/edit', [MenuController::class, 'edit'])->name('menus.edit');
    Route::put('/{menu}', [MenuController::class, 'update'])->name('menus.update');
    Route::delete('/{menu}', [MenuController::class, 'destroy'])->name('menus.destroy');
})->middleware(['auth', 'verified', 'superadmin']);

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


Route::post('/checkout', [CheckoutController::class, 'processCheckout'])->name('checkout');

Route::get('/checkout', [CheckoutController::class, 'showCheckoutForm'])->name('checkout.show');

Route::delete('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');

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

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ComingSoonController;

// Authentication routes
require _DIR_ . '/auth.php';
Route::get('/', function () {
    return view('home'); 
})->name('home')->middleware('auth');

Route::get('search', [HomeController::class, 'search'])->name('search');
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
    Route::get('/category/{category}', [ProductController::class, 'showByCategory'])->name('products.category');
    Route::get('/{product}', [ProductController::class, 'show'])->name('products.show');
    Route::get('/addstock', [ProductController::class, 'addstock'])->name('products.addstock');
    Route::delete('/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
})->middleware(['auth', 'verified', 'superadmin', 'manager']);

Route::post('/product/info', [ProductController::class, 'getProductInfo'])->name('product.info');
Route::post('/products/updatestock', [ProductController::class, 'updatestock'])->name('products.updatestock');

Route::resource('sliders', SliderController::class);

Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
    Route::patch('/cart/{cart}/update', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{cart}', [CartController::class, 'destroy'])->name('checkout.destroy');
});

Route::prefix('menus')->group(function () {
    Route::get('/index', [MenuController::class, 'index'])->name('menus.index');
    Route::get('/create', [MenuController::class, 'create'])->name('menus.create');
    Route::post('/', [MenuController::class, 'store'])->name('menus.store');
    Route::get('/{menu}/edit', [MenuController::class, 'edit'])->name('menus.edit');
    Route::put('/{menu}', [MenuController::class, 'update'])->name('menus.update');
    Route::delete('/{menu}', [MenuController::class, 'destroy'])->name('menus.destroy');
})->middleware(['auth', 'verified', 'superadmin']);

Route::prefix('superadmin')->group(function () {
    Route::get('/', [SuperAdminController::class, 'index'])->name('superadmin.index');
})->middleware(['auth', 'verified', 'superadmin']);

Route::get('/', [HomeController::class, 'index'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::prefix('checkout')->middleware('auth')->group(function () {
    Route::post('/', [CheckoutController::class, 'showCheckoutForm'])->name('checkout.show');
    Route::post('/process', [CheckoutController::class, 'processCheckout'])->name('checkout.process');
});

// Route::get('/comingsoon', [ComingSoonController::class, 'index'])->name('comingsoon');
Route::view('/comingsoon', 'comingsoon')->name('comingsoon');
// Route::prefix('transaction')->middleware('auth')->group(function () {
//     Route::get('/{id}/show', [TransactionController::class, 'show'])->name('transactions.show');
// });


Route::prefix('discount_products')->name('discount.')->group(function () {
    Route::get('/', [DiscountProductController::class, 'index'])->name('index');
    Route::get('/create', [DiscountProductController::class, 'create'])->name('create');
    Route::post('/', [DiscountProductController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [DiscountProductController::class, 'edit'])->name('edit');
    Route::put('/{id}', [DiscountProductController::class, 'update'])->name('update');
    Route::delete('/{id}', [DiscountProductController::class, 'destroy'])->name('destroy');
<<<<<<< HEAD
});
=======
});


Route::resource('transactions', TransactionController::class);
>>>>>>> 080968ea05f7ed2e649df38d332473a50db46ed0

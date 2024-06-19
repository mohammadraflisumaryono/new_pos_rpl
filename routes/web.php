<?php

use App\Http\Middleware\SuperAdmin;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Middleware\CheckRoleMiddleware;
use App\Http\Controllers\{
    HomeController,
    ProfileController,
    SuperAdminController,
    ManagerController,
    KasirController,
    MenuController,
    ProductController,
    CategoryController,
    DiscountProductController,
    SliderController,
    CartController,
    CheckoutController,
    TransactionController,
    UserController
};


//  ROLE 
//     1 = User
//     2 = Kasir
//     3 = Manager
//     4 = Super Admin


require __DIR__ . '/auth.php';

// single page

Route::get('/unauthorized', function () {
    return view('unauthorized');
})->name('unauthorized');

Route::get('/', [HomeController::class, 'index'])->name('dashboard');
Route::view('/comingsoon', 'comingsoon')->name('comingsoon');
Route::get('search', [HomeController::class, 'search'])->name('search');
Route::get('/search/?', [HomeController::class, 'search'])->name('searchPage');




// Super Admin
Route::prefix('superadmin')->middleware(['auth', 'verified', 'role:4'])->group(function () {
    Route::get('/', [SuperAdminController::class, 'index'])->name('superadmin.index');
    Route::get('/users', [UserController::class, 'index'])->name('user.index');

// Menampilkan form tambah user
Route::get('/users/create', [UserController::class, 'create'])->name('user.create');

// Menyimpan data user baru
Route::post('/users', [UserController::class, 'store'])->name('user.store');

// Menampilkan form edit user
Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('user.edit');

// Menyimpan data user yang diedit
Route::put('/users/{id}', [UserController::class, 'update'])->name('user.update');

// Menghapus user
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('user.destroy');
   
});
Route::prefix('menus')->middleware(['auth', 'verified', 'role:4'])->group(function () {
    Route::get('/index', [MenuController::class, 'index'])->name('menus.index');
    Route::get('/create', [MenuController::class, 'create'])->name('menus.create');
    Route::post('/', [MenuController::class, 'store'])->name('menus.store');
    Route::get('/{menu}/edit', [MenuController::class, 'edit'])->name('menus.edit');
    Route::put('/{menu}', [MenuController::class, 'update'])->name('menus.update');
    Route::delete('/{menu}', [MenuController::class, 'destroy'])->name('menus.destroy');
});



// Resource routes for products and categories
Route::prefix('categories')->middleware(['auth', 'verified', 'role:4'])->group(function () {
    Route::get('/index', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
});

Route::get('products/', [ProductController::class, 'index'])->middleware('auth', 'role:2,3,4')->name('products.index');
Route::get('/products/addstock', [ProductController::class, 'addStock'])->middleware('auth', 'role:2,3,4')->name('products.addstock');
Route::post('/products/updatestock', [ProductController::class, 'updatestock'])->middleware('auth', 'role:2,3,4')->name('products.updatestock');


Route::prefix('products')->middleware(['auth', 'verified', 'role:4,3'])->group(function () {
    Route::get('/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/', [ProductController::class, 'store'])->name('products.store');
    Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/{product}', [ProductController::class, 'update'])->name('products.update');

    Route::get('/display', [ProductController::class, 'display'])->name('products.display');
    Route::get('/{product}', [ProductController::class, 'show'])->name('products.show');

    Route::delete('/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
    Route::get('/{category}/category', [ProductController::class, 'showByCategory'])->name('products.category');
});

Route::post('/product/info', [ProductController::class, 'getProductInfo'])->name('product.info');

Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
    Route::patch('/cart/{cart}/update', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{cart}', [CartController::class, 'destroy'])->name('checkout.destroy');
});

Route::resource('sliders', SliderController::class)->middleware(['auth', 'verified', 'role:4,3']);

Route::prefix('manager')->middleware(['auth', 'verified', 'role:3,4'])->group(function () {
    Route::get('/', [ManagerController::class, 'index'])->name('manager.index');
    Route::get('/datakasir', [ManagerController::class, 'datakasir'])->name('manager.datakasir');
    // Route::get('/users', [ManagerController::class, 'dataUser'])->name('manager.users');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::prefix('checkout')->middleware('auth')->group(function () {
    Route::post('/', [CheckoutController::class, 'showCheckoutForm'])->name('checkout.show');
    Route::post('/process', [CheckoutController::class, 'processCheckout'])->name('checkout.process');
});


Route::prefix('discount_products')->middleware('auth', 'role:3,4')->name('discount.')->group(function () {
    Route::get('/', [DiscountProductController::class, 'index'])->name('index');
    Route::get('/create', [DiscountProductController::class, 'create'])->name('create');
    Route::post('/', [DiscountProductController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [DiscountProductController::class, 'edit'])->name('edit');
    Route::put('/{id}', [DiscountProductController::class, 'update'])->name('update');
    Route::delete('/{id}', [DiscountProductController::class, 'destroy'])->name('destroy');
});

Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
Route::get('/transactions/riwayat', [TransactionController::class, 'riwayattransaksi'])->name('transactions.riwayattransaksi');
Route::get('/transactions/{transaction}/edit', [TransactionController::class, 'edit'])->name('transactions.edit');
Route::post('/transactions/{transaction}', [TransactionController::class, 'post'])->name('transactions.update');
Route::get('/transactions/{transaction}/show', [TransactionController::class, 'show'])->name('transactions.show');
Route::get('/transactions/{transaction}/success', [TransactionController::class, 'success'])->name('transactions.success');

Route::get('/transactions/{id}/edit-status', [TransactionController::class, 'editStatus'])->name('transactions.editStatus');
Route::post('/transactions/{id}/update-status', [TransactionController::class, 'updateStatus'])->name('transactions.updateStatus');




Route::prefix('kasir')->middleware('auth', 'role:2,4')->group(function () {
    Route::get('/', [KasirController::class, 'index'])->name('kasir.index');
    Route::get('/cekpesanan', [KasirController::class, 'cekPesanan'])->name('kasir.cekpesanan');
});

// Route::get('transactions/{transaction}/show', [TransactionController::class, 'show'])->name('transactions.show');
// Route::get('transactions/', [TransactionController::class, 'index'])->name('transactions.index');
// Route::get('transactions/riwayattransaksi', TransactionController::class)->name('transactions.riwayattransaksi');

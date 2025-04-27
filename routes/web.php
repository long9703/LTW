<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Client\ProductController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\CheckoutController;

//Auth
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// Client

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/product_search', [ProductController::class, 'search'])->name('product_search');


Route::get('/products', [ProductController::class, 'index'])->name('product');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product_detail');

Route::prefix('cart')->middleware('auth')->group(function () {
    Route::post('/cart/add', [CartController::class, 'add'])->middleware('auth')->name('cart.add');
    Route::post('update/{id}', [CartController::class, 'update']);
    Route::delete('delete/{id}', [CartController::class, 'delete']);
    Route::get('', [CartController::class, 'index'])->name('cart');
});


Route::get('/checkout', [CheckoutController::class, 'showCheckoutPage'])->middleware('auth')->name('checkout');
Route::post('/checkout', [CheckoutController::class, 'processCheckout'])->middleware('auth')->name('checkout.process');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');



//Admin

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\UserController;

Route::prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Categories
    Route::resource('categories', CategoryController::class);

    // Products
    Route::resource('products', AdminProductController::class);

    // Orders
    
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}/details', [OrderController::class, 'show'])->name('orders.show');
    Route::post('/orders/update-status/{order}', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');


   //User
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
    Route::post('/users/{id}/update-role', [UserController::class, 'updateRole'])->name('users.updateRole');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy'); // Thêm route xóa
});

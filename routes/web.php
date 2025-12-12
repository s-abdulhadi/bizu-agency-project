<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public Pages
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [PageController::class, 'submitContact'])->name('contact.submit');
Route::get('/testimonials', [PageController::class, 'testimonials'])->name('testimonials');

// AJAX Search
Route::get('/ajax/search', [App\Http\Controllers\SearchController::class, 'search'])->name('search.ajax');

// Services
Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
Route::get('/services/{slug}', [ServiceController::class, 'show'])->name('services.show');

// Portfolio
Route::get('/portfolio', [PortfolioController::class, 'index'])->name('portfolio.index');
Route::get('/portfolio/{slug}', [PortfolioController::class, 'show'])->name('portfolio.show');

// Products
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{slug}', [ProductController::class, 'show'])->name('products.show');

// Cart Routes
Route::get('/cart', [App\Http\Controllers\CartController::class, 'index'])->name('cart.index');
Route::get('/cart/add/{type}/{id}', [App\Http\Controllers\CartController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/add/{type}/{id}', [App\Http\Controllers\CartController::class, 'addToCart'])->name('cart.store');
Route::patch('/cart/update', [App\Http\Controllers\CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove', [App\Http\Controllers\CartController::class, 'remove'])->name('cart.remove');

// Checkout (Placeholder)
Route::get('/checkout', [App\Http\Controllers\CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [App\Http\Controllers\CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/checkout/thank-you/{order}', [App\Http\Controllers\CheckoutController::class, 'thankyou'])->name('thankyou');

// Admin Routes (Placeholder)
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.dashboard');
    // Manage Routes
    Route::resource('services', App\Http\Controllers\Admin\ServiceController::class)->names('admin.services');
    Route::resource('portfolio', App\Http\Controllers\Admin\PortfolioController::class)->names('admin.portfolio');
    Route::resource('orders', App\Http\Controllers\Admin\OrderController::class)->except(['create', 'store', 'destroy'])->names('admin.orders');
    Route::resource('users', App\Http\Controllers\Admin\UserController::class)->only(['index', 'destroy'])->names('admin.users');
    Route::resource('products', App\Http\Controllers\Admin\ProductController::class)->names('admin.products');
});

// Auth Routes
Route::get('/login', [App\Http\Controllers\AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [App\Http\Controllers\AuthController::class, 'login'])->name('login.post');
Route::get('/register', [App\Http\Controllers\AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [App\Http\Controllers\AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

// User Dashboard (for regular users)
Route::get('/account', [App\Http\Controllers\UserDashboardController::class, 'index'])->middleware('auth')->name('user.dashboard');

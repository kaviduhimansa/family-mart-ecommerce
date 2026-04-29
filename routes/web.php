<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Auth\LoginController; // Import the LoginController
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

// Home page route
Route::get('/', [ProductController::class, 'index'])->name('home');

// Login page view route
Route::get('/login', function () {
    return view('auth.login'); 
})->name('login');

// --- Google Authentication Routes ---
// This defines the 'google.login' route that your blade file is looking for
Route::get('auth/google', [LoginController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [LoginController::class, 'handleGoogleCallback']);
// ------------------------------------

//logout route
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/')->with('success', 'Logged out successfully!');
})->name('logout');


// Cart routes
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::get('/add-to-cart/{id}', [CartController::class, 'addToCart'])->name('cart.add');
Route::delete('/remove-from-cart', [CartController::class, 'remove'])->name('cart.remove');
Route::patch('/update-cart', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove-one/{id}', [CartController::class, 'removeOne'])->name('cart.removeOne');

//admin routes
Route::middleware(['auth', 'is_admin'])->prefix('admin')->group(function () {
Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
Route::get('/products/create', [AdminController::class, 'create'])->name('admin.products.create');
Route::post('/products/store', [AdminController::class, 'store'])->name('admin.products.store');
Route::delete('/products/{product}', [AdminController::class, 'destroy'])->name('admin.products.destroy');
Route::get('/products/{product}/edit', [AdminController::class, 'edit'])->name('admin.products.edit');
Route::put('/products/{product}', [AdminController::class, 'update'])->name('admin.products.update'); 
Route::get('/admin/categories', [AdminController::class, 'categoriesIndex'])->name('admin.categories.index');   
});

Route::post('/logout', function (Request $request) {
    
    session()->forget('cart');

    Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/');
})->name('logout');
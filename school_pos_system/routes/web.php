<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\POSController;

Route::get('/', function () {
    return redirect('/pos');
});

// POS Routes
Route::prefix('pos')->group(function () {
    Route::get('/', [POSController::class, 'index'])->name('pos.index');
    Route::post('/process-sale', [POSController::class, 'processSale'])->name('pos.process-sale');
    Route::get('/receipt/{sale}', [POSController::class, 'receipt'])->name('pos.receipt');
});

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Resource Routes
Route::resource('categories', CategoryController::class);
Route::resource('products', ProductController::class);
Route::resource('customers', CustomerController::class);
Route::resource('sales', SaleController::class);

// API Routes for POS
Route::prefix('api')->group(function () {
    Route::get('/products/search', [ProductController::class, 'search'])->name('api.products.search');
    Route::get('/customers/search', [CustomerController::class, 'search'])->name('api.customers.search');
    Route::get('/product/{id}', [ProductController::class, 'show'])->name('api.product.show');
});

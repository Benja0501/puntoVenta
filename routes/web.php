<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientController;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', function () {
    return view('layouts.admin');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('categories', 'CategoryController')->names('categories');
Route::resource('clients', 'ClientController')->names('clients');
Route::resource('products', 'ProductController')->names('products');
Route::resource('providers', 'ProviderController')->names('providers');
Route::resource('purchases', 'PurchaseController')->names('purchases');
Route::resource('sales', 'SaleController')->names('sales');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

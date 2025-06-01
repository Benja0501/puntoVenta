<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SaleController;

Route::get('/', function () {
    return view('welcome');
});
// Todas estas rutas requieren estar autenticado (y verificado, si usas email verification)
Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        return view('layouts.admin');
    })->name('dashboard');

    // Recursos CRUD
    Route::resource('categories', CategoryController::class)->names('categories');
    Route::resource('clients', ClientController::class)->names('clients');
    Route::resource('products', ProductController::class)->names('products');
    Route::resource('providers', ProviderController::class)->names('providers');
    Route::resource('purchases', PurchaseController::class)->names('purchases');
    Route::resource('sales', SaleController::class)->names('sales');
    // Ruta para generar/mostrar el PDF:
    Route::get('purchases/{purchase}/pdf', [PurchaseController::class, 'pdf'])
        ->name('purchases.pdf');
    Route::get('sales/{sale}/pdf', [SaleController::class, 'pdf'])
        ->name('sales.pdf');

    Route::get('/dashboard', function () {
        return view('layouts.admin');
    })->middleware(['auth', 'verified'])->name('dashboard');
});

require __DIR__ . '/auth.php';

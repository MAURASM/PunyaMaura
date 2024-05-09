<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminProductCategoryController;
use App\Http\Controllers\ResellerController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\SupplierProductController;
use App\Http\Controllers\SupplierOrderController;



Route::get('/', [HomeController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/dashboard', [HomeController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/admin', [HomeController::class, 'index'])->middleware(['auth', 'admin']);

Route::resource('/admin/product-categories', AdminProductCategoryController::class)->middleware(['auth', 'admin']);
Route::resource('/admin/users', UserController::class)->middleware(['auth', 'admin']);


Route::middleware(['auth', 'supplier'])->group(function () {

    // Supplier Dashboard and Profile
    Route::get('/supplier', [SupplierController::class, 'index'])->name('supplier.index');
    Route::get('/supplier/{id}/edit', [SupplierController::class, 'edit'])->name('supplier.edit');
    Route::put('/supplier/{id}', [SupplierController::class, 'update'])->name('supplier.update');

    // Product
    Route::get('/supplier/product', [SupplierProductController::class, 'index'])->name('supplier.product.index');
    Route::post('/supplier/product', [SupplierProductController::class, 'store'])->name('supplier.product.store');
    Route::put('/supplier/product/{id}', [SupplierProductController::class, 'update'])->name('supplier.product.update');
    Route::delete('/supplier/product/{id}', [SupplierProductController::class, 'destroy'])->name('supplier.product.destroy');
    Route::get('/supplier/stock', [SupplierProductController::class, 'stock'])->name('supplier.product.stock');

    // Order
    Route::get('/supplier/order', [SupplierOrderController::class, 'index'])->name('supplier.order.index');
    Route::put('/supplier/order/{id}', [SupplierOrderController::class, 'update'])->name('supplier.order.update');
    Route::get('/supplier/history', [SupplierOrderController::class, 'history'])->name('supplier.order.history');

    // Member
    Route::get('/supplier/member', [SupplierProductController::class, 'member'])->name('supplier.produk.member');
});

require __DIR__ . '/auth.php';

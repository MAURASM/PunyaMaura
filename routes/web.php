<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminTopicController;
use App\Http\Controllers\AdminProductCategoryController;
use App\Http\Controllers\AdminProductController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/admin', [HomeController::class, 'index'])->middleware(['auth', 'admin']);

Route::get('/admin/product-categories/checkSlug', [AdminProductCategoryController::class, 'checkSlug'])->middleware(['auth', 'admin']);
Route::get('/admin/topics/checkSlug', [AdminTopicController::class, 'checkSlug'])->middleware(['auth', 'admin']);

Route::resource('/admin/product-categories', AdminProductCategoryController::class)->middleware(['auth', 'admin']);
Route::resource('/admin/topics', AdminTopicController::class)->middleware(['auth', 'admin']);
Route::resource('/admin/users', UserController::class)->middleware(['auth', 'admin']);
Route::get('/admin/products', [AdminProductController::class, 'index'])->middleware(['auth', 'admin']);

require __DIR__.'/auth.php';

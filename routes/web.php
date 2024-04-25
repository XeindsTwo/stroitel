<?php

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

include 'pages/errors.php';

Route::get('/profile', [ProfileController::class, 'show'])->middleware('auth')->name('profile');
Route::get('/products', [ProductController::class, 'indexCatalog'])->middleware('checkdb')->name('catalog');
Route::get('/products/{id}', [ProductController::class, 'show'])->middleware('checkdb')->name('show_product');
<?php

use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware(['checkdb', 'admin'])->group(function () {
  Route::get('/products', [ProductController::class, 'indexPage'])->name('admin.products.index');
  Route::get('/products/create', [ProductController::class, 'createPage'])->name('admin.products.create');
  Route::post('/products', [ProductController::class, 'store'])->name('admin.products.store');
  Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('admin.products.edit');
  Route::post('/products/{id}/edit', [ProductController::class, 'update'])->name('admin.products.update');
  Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('admin.products.destroy');
});
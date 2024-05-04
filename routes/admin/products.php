<?php

use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware(['checkdb', 'admin'])->group(function () {
  Route::get('/products', [ProductController::class, 'indexPage'])->name('admin.products.index');
  Route::get('/products/categories/{category_id}',
    [ProductController::class, 'indexSubcategories'])
    ->name('admin.products.index_categories');
  Route::get('/products/categories/{category_id}/products', [ProductController::class, 'indexProducts'])
    ->name('admin.products.index_products');
  Route::get('/products/categories/{category_id}/subcategories/{subcategory_id}/products', [ProductController::class, 'indexSubcategoryProducts'])
    ->name('admin.products.index_subcategory_products');
  Route::get('/products/create', [ProductController::class, 'createPage'])->name('admin.products.create');
  Route::post('/products', [ProductController::class, 'store'])->name('admin.products.store');
  Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('admin.products.edit');
  Route::post('/products/{id}/edit', [ProductController::class, 'update'])->name('admin.products.update');
  Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('admin.products.destroy');
});
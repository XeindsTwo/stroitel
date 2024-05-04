<?php

use App\Http\Controllers\CatalogController;
use Illuminate\Support\Facades\Route;

Route::middleware('checkdb')->prefix('products')->group(function () {
  Route::get('/', [CatalogController::class, 'index'])->name('catalog');
  Route::get('/{id}', [CatalogController::class, 'show'])->name('show_product');

  Route::prefix('category')->group(function () {
    Route::get('/{categoryId}', [CatalogController::class, 'indexProducts'])->name('category.products');
    Route::get('/{categoryId}/subcategories', [CatalogController::class, 'indexSubcategories'])->name('category.subcategories');
    Route::get('/{categoryId}/subcategories/{subcategoryId}', [CatalogController::class, 'indexSubcategoryProducts'])->name('category.subcategory.products');
  });
});
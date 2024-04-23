<?php

use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Route;

Route::middleware(['admin', 'checkdb'])->prefix('admin/categories')->group(function () {
  Route::get('/', [CategoryController::class, 'index'])->name('admin.categories.index');
  Route::get('/create', [CategoryController::class, 'create'])->name('admin.categories.create');
  Route::post('/create', [CategoryController::class, 'store'])->name('admin.categories.store');
  Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('admin.categories.edit');
  Route::post('/edit/{id}', [CategoryController::class, 'update'])->name('admin.categories.update');
  Route::delete('/{id}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');
});
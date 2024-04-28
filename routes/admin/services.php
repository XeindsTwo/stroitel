<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ServiceController;
use Illuminate\Support\Facades\Route;

Route::middleware(['admin', 'checkdb'])->prefix('admin/services')->group(function () {
  Route::get('/', [ServiceController::class, 'index'])->name('admin.services.index');
  Route::delete('/{id}', [ServiceController::class, 'destroy'])->name('admin.services.destroy');
});
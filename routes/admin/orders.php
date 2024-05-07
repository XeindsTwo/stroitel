<?php

use App\Http\Controllers\Admin\OrderController;
use Illuminate\Support\Facades\Route;

Route::middleware(['admin', 'checkdb'])->prefix('admin')->group(function () {
  Route::get('/orders', [OrderController::class, 'index'])->name('admin.orders.index');
  Route::delete('/orders/{id}', [OrderController::class, 'destroy'])->name('admin.orders.destroy');
});
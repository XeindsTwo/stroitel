<?php

use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'checkdb'], static function () {
  Route::get('/order', [OrderController::class, 'index'])->name('order.index');
  Route::post('/order', [OrderController::class, 'store'])->middleware('auth')->name('order.store');
});
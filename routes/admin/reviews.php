<?php

use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

Route::middleware(['admin', 'checkdb'])->group(function () {
  Route::get('/admin/reviews', [ReviewController::class, 'index']);
});
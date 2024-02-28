<?php

use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

Route::middleware('checkdb')->group(function () {
  Route::post('/reviews', [ReviewController::class, 'store'])->name('send_review');
  Route::get('/reviews', [ReviewController::class, 'showReviewsPage'])->name('reviews');
});
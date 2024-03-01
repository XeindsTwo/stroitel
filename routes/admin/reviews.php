<?php

use App\Http\Controllers\Admin\ReviewController;
use Illuminate\Support\Facades\Route;

Route::middleware(['admin', 'checkdb'])->prefix('admin')->group(function () {
  Route::get('/reviews', [ReviewController::class, 'unapproved'])->name('admin.reviews');
  Route::get('/reviews/approved', [ReviewController::class, 'approved'])->name('admin.reviews.approved');
  Route::put('/reviews/{id}/approve', [ReviewController::class, 'approve'])->name('admin.reviews.approve');
  Route::put('/reviews/{id}/reject', [ReviewController::class, 'reject'])->name('admin.reviews.reject');
  Route::delete('/reviews/{id}', [ReviewController::class, 'destroy'])->name('admin.reviews.destroy');
});
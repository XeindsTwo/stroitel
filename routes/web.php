<?php

use App\Http\Controllers\CatalogController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
  Route::prefix('profile')->group(function () {
    Route::get('/', [ProfileController::class, 'show'])->name('profile');
    Route::post('/update', [ProfileController::class, 'update'])->name('profile.update');
  });
});

Route::middleware(['checkdb'])->group(function () {
  Route::get('/search', [SearchController::class, 'search'])->name('search');
  Route::get('/discounted', [CatalogController::class, 'indexDiscounted'])->name('discounted');
});
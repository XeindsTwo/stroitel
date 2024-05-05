<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;

Route::get('/profile', [ProfileController::class, 'show'])->middleware('auth')->name('profile');
Route::get('/search', [SearchController::class, 'search'])->name('search');
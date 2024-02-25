<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

include 'pages/errors.php';

Route::get('/profile', [ProfileController::class, 'show'])->middleware('auth')->name('profile');
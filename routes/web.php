<?php

use App\Http\Controllers\CaptchaController;
use Illuminate\Support\Facades\Route;

include 'errors.php';

Route::get('/generate-captcha', [CaptchaController::class, 'generateCaptcha'])->name('generate-captcha');
Route::post('/validate-captcha', [CaptchaController::class, 'validateCaptcha']);
Route::get('/profile', function () {
  return view('profile');
})->middleware('auth');
<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'checkdb'], static function () {
  Route::get('/', [HomeController::class, 'index'])->name('index');
  Route::get('/contacts', static function () {
    return view('contacts');
  })->name('contacts');
  Route::get('/privacy', static function () {
    return view('privacy-policy');
  })->name('privacy');
  Route::get('/about', static function () {
    return view('company.about');
  })->name('about');
  Route::get('/payment_delivery', static function () {
    return view('company.payment_delivery');
  })->name('payment_delivery');
  Route::get('/faq', static function () {
    return view('company.faq');
  })->name('faq');
  Route::get('/letters', static function () {
    return view('company.letters');
  })->name('letters');
  Route::get('/partneram', static function () {
    return view('partneram');
  })->name('partneram');
});
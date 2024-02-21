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
});
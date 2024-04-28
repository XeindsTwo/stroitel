<?php

use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'checkdb', 'prefix' => 'uslugi'], static function () {
  Route::get('/', function () {
    return view('services.uslugi');
  })->name('services.uslugi');
  Route::get('/dostavka-strojmaterialov', function () {
    return view('services.strojmaterialov');
  })->name('services.strojmateriali');
  Route::get('/raspil', function () {
    return view('services.raspil');
  })->name('services.raspil');
  Route::get('/coloring-of-decorative-plaster-and-paints', function () {
    return view('services.coloring');
  })->name('services.coloring');
  Route::post('/store', [ServiceController::class, 'store'])->name('services.store');
});
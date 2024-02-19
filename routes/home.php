<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'checkdb'], static function () {
  Route::get('/', [HomeController::class, 'index'])->name('index');
});
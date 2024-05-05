<?php

use App\Http\Controllers\CardController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'checkdb'], static function () {
  Route::get('/favorites', [CardController::class, 'favorites'])->name('card.favorites');
  Route::post('/favorites/products', [CardController::class, 'getFavoriteProductsInfo'])->name('card.favorites.products');
});
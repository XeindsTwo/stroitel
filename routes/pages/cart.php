<?php

use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'checkdb'], static function () {
  Route::prefix('favorites')->group(static function () {
    Route::get('/', [CartController::class, 'favorites'])->name('cart.favorites');
    Route::post('/products', [CartController::class, 'getFavoriteProductsInfo'])->name('cart.products');
  });
  Route::post('/add-to-cart/{productId}', [CartController::class, 'addToCart'])->name('cart.add_to_cart');
  Route::prefix('cart')->group(function () {
    Route::get('/', [CartController::class, 'showCart'])->name('cart.show_cart');
    Route::delete('/remove', [CartController::class, 'removeFromCart'])->name('cart.remove');
    Route::post('/update/{cart_id}', [CartController::class, 'updateCartItemQuantity'])->name('cart.update');
  });
});
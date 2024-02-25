<?php

use App\Http\Controllers\PartnershipRequestController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'checkdb'], static function () {
  Route::post('/partnership-requests', [PartnershipRequestController::class, 'store'])
    ->name('partnership-requests.store');
});
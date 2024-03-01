<?php

use App\Http\Controllers\Admin\PartnershipRequestController;
use Illuminate\Support\Facades\Route;

Route::middleware(['admin', 'checkdb'])->prefix('admin')->group(function () {
  Route::get('/partnership-requests', [PartnershipRequestController::class, 'index'])->name('admin.partnership-requests');
  Route::delete('/partnership-requests/{id}', [PartnershipRequestController::class, 'destroy'])->name('admin.partnership-requests.destroy');
});
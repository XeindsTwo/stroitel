<?php

use App\Http\Controllers\Admin\PartnershipRequestController;
use Illuminate\Support\Facades\Route;

Route::middleware(['admin', 'checkdb'])->group(function () {
  Route::get('/admin/partnership-requests', [PartnershipRequestController::class, 'index'])->name('admin.partnership-requests');
});
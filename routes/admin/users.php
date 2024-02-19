<?php

use App\Http\Controllers\Admin\UserController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['admin'])->group(function () {
    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/users/all', [UserController::class, 'getAllUsers']);
    Route::get('/admin/users/search', [UserController::class, 'search'])->name('admin.users.search');
    Route::post('/admin/users', [UserController::class, 'store'])->name('admin.users.store');
    Route::get('/admin/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/admin/users/{user}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/admin/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');

    Route::post('/check-email-create', function (Request $request) {
        $email = $request->input('email');
        $user = User::where('email', $email)->first();
        return response()->json([
            'exists' => !!$user,
        ]);
    });

    Route::post('/check-login-create', function (Request $request) {
        $login = $request->input('login');
        $user = User::where('login', $login)->first();
        return response()->json([
            'exists' => !!$user,
        ]);
    });

    Route::post('/check-email-edit', function (Request $request) {
        $email = $request->input('email');
        $userId = $request->input('userId');
        $user = User::where('email', $email)->where('id', '!=', $userId)->first();
        return response()->json([
            'exists' => !!$user,
        ]);
    });

    Route::post('/check-login-edit', function (Request $request) {
        $login = $request->input('login');
        $userId = $request->input('userId');
        $user = User::where('login', $login)->where('id', '!=', $userId)->first();
        return response()->json([
            'exists' => !!$user,
        ]);
    });
});
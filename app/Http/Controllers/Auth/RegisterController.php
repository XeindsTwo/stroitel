<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
  public function register(Request $request)
  {
    DB::beginTransaction();
    try {
      $validatedData = $request->validate([
        'login' => 'required|string|min:5|max:60|unique:users|regex:/^[a-zA-Z0-9_]+$/',
        'name' => 'required|string|min:2|max:50|regex:/^[A-Za-zА-Яа-яЁё\s\-]+$/u',
        'email' => 'required|email|max:120|unique:users,email',
        'password' => 'required|string|min:8|max:60|regex:/^[^\p{Cyrillic}]+$/u',
      ]);

      User::create([
        'login' => $validatedData['login'],
        'name' => $validatedData['name'],
        'email' => $validatedData['email'],
        'password' => Hash::make($validatedData['password']),
        'role' => 'USER',
      ]);

      DB::commit();
      return redirect()->route('login')->with('success', 'Регистрация прошла успешно!');
    } catch (Exception $e) {
      DB::rollBack();
      return response()->json(['message' => 'Ошибка при регистрации', 'error' => $e->getMessage()], 500);
    }
  }

  public function showRegisterForm(): Factory|Application|View|Redirector|\Illuminate\Contracts\Foundation\Application|RedirectResponse
  {
    if (Auth::check()) {
      return redirect('/');
    }
    return view('register');
  }
}
<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class ProfileController extends Controller
{
  public function show()
  {
    $user = Auth::user();
    $orders = $user->orders()->with('products')->get();

    return view('profile', ['user' => $user, 'orders' => $orders]);
  }

  public function update(Request $request)
  {
    try {
      $request->validate([
        'name' => 'required|string|min:2|max:50|regex:/^[A-Za-zА-Яа-яЁё\s\-]+$/u',
        'email' => 'required|string|email|max:255|unique:users,email,' . auth()->id(),
      ]);

      $user = auth()->user();
      $user->name = $request->name;
      $user->email = $request->email;
      $user->save();

      return response()->json(['message' => 'Профиль успешно обновлен']);
    } catch (ValidationException $e) {
      return response()->json(['error' => $e->errors()], 422);
    } catch (Exception) {
      return response()->json(['error' => 'Что-то пошло не так. Попробуйте позже.'], 500);
    }
  }
}
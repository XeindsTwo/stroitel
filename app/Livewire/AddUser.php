<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class AddUser extends Component
{
  public $login;
  public $name;
  public $email;
  public $password;
  public $role = 'USER';
  public $users;

  public function render(): View|Application|Factory|\Illuminate\View\View|\Illuminate\Contracts\Foundation\Application
  {
    $this->users = User::all();
    return view('livewire.add-user');
  }

  public function addUser(): Application|Redirector|RedirectResponse|\Illuminate\Contracts\Foundation\Application
  {
    // Проверяем, аутентифицирован ли пользователь
    if (Auth::check()) {
      if (Auth::user()->can('add')) {
        $validatedData = $this->validate([
          'login' => 'required|string|min:5|max:60|unique:users|regex:/^[a-zA-Z0-9_]+$/',
          'name' => 'required|string|min:2|max:50|regex:/^[A-Za-zА-Яа-яЁё\s\-]+$/u',
          'email' => 'required|email|unique:users,email',
          'password' => 'required|string|min:8|max:60|regex:/^[a-zA-Z0-9_]+$/',
          'role' => 'required|string|in:USER,ADMIN',
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);
        User::create($validatedData);

        $this->users = User::all();
        $this->reset(['login', 'name', 'email', 'password', 'role']);
        session()->flash('message', 'Пользователь успешно добавлен!');

        return redirect()->to(route('add-user'));
      } else {
        return redirect('/503_error');
      }
    } else {
      return redirect('/login');
    }
  }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $users = User::query();
        $roles = User::distinct()->pluck('role');

        $users = $users->get();
        return view('admin.manage_users', compact('users', 'roles'));
    }

    public function getAllUsers(): JsonResponse
    {
        $users = User::all();
        return response()->json(['users' => $users]);
    }

    public function search(Request $request): JsonResponse
    {
        $query = $request->input('query');
        $usersQuery = User::query()
            ->where('login', 'like', "%$query%")
            ->orWhere('name', 'like', "%$query%")
            ->orWhere('email', 'like', "%$query%");

        $users = $query ? $usersQuery->get() : collect([]);
        return response()->json(['users' => $users]);
    }

    public function store(StoreUserRequest $request): JsonResponse
    {
        $validatedData = $request->validate([
            'login' => 'required|string|min:5|max:60|unique:users|regex:/^[a-zA-Z0-9_]+$/',
            'name' => 'required|string|min:2|max:50|regex:/^[A-Za-zА-Яа-яЁё\-]+$/u',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|max:60',
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);
        $validatedData['role'] = $request->input('role', 'USER');
        $user = User::create($validatedData);

        return response()->json(['message' => 'Пользователь успешно добавлен', 'user' => $user]);
    }

    public function edit(User $user): View|Factory|Application
    {
        return view('admin.edit_user', compact('user'));
    }

    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        $validatedData = $request->validated();
        $user->update($validatedData);
        return redirect()->route('admin.users.index')->with('success', 'Пользователь успешно обновлен');
    }

    public function destroy(User $user): JsonResponse
    {
        $user->delete();
        return response()->json(['message' => 'Пользователь успешно удален']);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = trim((string) $request->query('search', ''));
        $role = $request->query('role', 'all');

        $users = User::query()
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            })
            ->when($role !== 'all', fn ($query) => $query->where('role', $role))
            ->latest()
            ->get();

        return view('pages.dashboard.users', compact('users', 'search', 'role'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'role' => ['required', Rule::in(['user', 'admin'])],
            'password' => ['required', 'string', 'min:8'],
        ]);

        User::create($data);

        return back()->with('success', 'User created');
    }

    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'role' => ['required', Rule::in(['user', 'admin'])],
            'password' => ['nullable', 'string', 'min:8'],
        ]);

        if (blank($data['password'])) {
            unset($data['password']);
        }

        $user->update($data);

        return back()->with('success', 'User updated');
    }

    public function destroy(string $id)
    {
        User::findOrFail($id)->delete();
        return back()->with('success', 'User deleted');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class UserAdministrationController extends Controller
{
    public function index(): View
    {
        return view('admin.users.index', [
            'users' => User::with('roles')->orderBy('codename')->get(),
        ]);
    }

    public function create(): View
    {
        return view('admin.users.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'codename' => ['required', 'string', 'max:255', 'unique:users,codename'],
            'specialty' => ['required', 'string', 'max:255'],
            'role' => ['required', 'string', 'in:Admin,Staff,Hitman'],
            'name' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'codename' => $validated['codename'],
            'specialty' => $validated['specialty'],
            'role' => $validated['role'],
            'name' => $validated['name'] ?: $validated['codename'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        $role = Role::firstOrCreate(['name' => $validated['role']]);
        $user->roles()->syncWithoutDetaching($role->id);

        return redirect()->route('admin.users.index')->with('status', 'A new syndicate account was created.');
    }

    public function destroy(User $user): RedirectResponse
    {
        $isCurrentUser = auth()->id() === $user->id;

        if ($isCurrentUser) {
            auth()->logout();
        }

        $user->delete();

        if ($isCurrentUser) {
            request()->session()->invalidate();
            request()->session()->regenerateToken();

            return redirect('/')->with('status', 'Your account was removed.');
        }

        return back()->with('status', 'The account was removed.');
    }
}
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use App\Models\HitmanApplication;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
            'codename'  => ['required', 'string', 'max:255', 'unique:users,codename', 'unique:hitman_applications,codename'],
            'specialty' => ['required', 'string', 'max:255'],
            'role'      => ['required', 'string', 'in:Admin,Staff,Hitman'],
            'email'     => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email', 'unique:hitman_applications,email'],
            'password'  => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Wrap operations in a transaction to protect data integrity
        DB::transaction(function () use ($validated) {
            
            // 1. Initialize the primary User profile
            $user = User::create([
                'codename'  => $validated['codename'],
                'specialty' => $validated['specialty'],
                'role'      => $validated['role'],
                'email'     => $validated['email'],
                'password'  => Hash::make($validated['password']),
            ]);

            // 2. Attach security system role metrics
            $role = Role::firstOrCreate(['name' => $validated['role']]);
            $user->roles()->syncWithoutDetaching($role->id);

            // 3. Mirror the application dossier tracking row as pre-vetted
            HitmanApplication::create([
                'user_id'           => $user->id,
                'codename'          => $validated['codename'],
                'specialty'         => $validated['specialty'],
                'email'             => $validated['email'],
                'password'          => $user->password, // Keeps hash history identical
                'status'            => 'approved',      // Pre-approved context flag
                'reviewed_by'       => Auth::id(),      // Stamps the active admin ID
                'reviewed_at'       => now(),
                'referral_codename' => Auth::user()->codename ?? 'HQ Direct Entry',
            ]);
        });

        return redirect()->route('admin.users.index')->with('status', 'Syndicate files synced. Account initialized and dossier approved.');
    }

    public function destroy(User $user): RedirectResponse
    {
        $isCurrentUser = auth()->id() === $user->id;

        if ($isCurrentUser) {
            // Log out the currently authenticated admin if they are deleting themselves.
            auth()->logout();
        }

        // Clean up both user and related application data cascadingly
        DB::transaction(function () use ($user) {
            $user->hitmanApplication()->delete();
            $user->delete();
        });

        if ($isCurrentUser) {
            // Invalidate the session database payload to prevent future session hijacking attempts.
            request()->session()->invalidate();
            
            // Regenerate the CSRF token to complete session cleanup.
            request()->session()->regenerateToken();

            return redirect('/')->with('status', 'Your profile and system signatures have been erased.');
        }

        return back()->with('status', 'Dossier profile deleted successfully.');
    }
}
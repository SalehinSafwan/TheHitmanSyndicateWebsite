<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\HitmanApplication;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
    $request->validate([
        'codename' => ['required', 'string', 'max:255', 'unique:users', 'unique:hitman_applications'],
        'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users', 'unique:hitman_applications'],
        'password' => ['required', 'confirmed', \Illuminate\Validation\Rules\Password::defaults()],
    ]);

    HitmanApplication::create([
        'codename' => $request->codename,
        'email' => $request->email,
        'password' => Hash::make($request->password), // Stored until approved
        'specialty' => $request->specialty,
        'status' => 'pending',
        'referral_codename' => $request->input('referral_codename', null),
    ]);

    return redirect()->route('login')
        ->with('status', 'CLASSIFIED TRANSMISSION RECEIVED. STAND BY FOR CLEARANCE.');
    }
}
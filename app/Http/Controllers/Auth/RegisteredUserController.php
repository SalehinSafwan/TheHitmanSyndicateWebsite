<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\HitmanApplication;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

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
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'codename' => ['required', 'string', 'max:255', Rule::unique('users', 'codename'), Rule::unique('hitman_applications', 'codename')],
            'specialty' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique('users', 'email'), Rule::unique('hitman_applications', 'email')],
            'referral_codename' => [
                'required',
                'string',
                'max:255',
                Rule::exists('users', 'codename')->where(fn ($query) => $query->where('role', 'Hitman')),
            ],
            'currency_answer' => ['required', 'in:Gold coins'],
            'hotel_rule_answer' => ['required', 'in:No business on continental grounds'],
            'best_weapon_answer' => ['required', 'in:Fiber wire'],
            'motivation' => ['required', 'string', 'max:2000'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        HitmanApplication::create([
            'codename' => $request->codename,
            'specialty' => $request->specialty,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'referral_codename' => $request->referral_codename,
            'currency_answer' => $request->currency_answer,
            'hotel_rule_answer' => $request->hotel_rule_answer,
            'best_weapon_answer' => $request->best_weapon_answer,
            'motivation' => $request->motivation,
            'status' => 'pending',
        ]);

        return redirect()->route('register.pending');
    }
}

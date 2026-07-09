<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\HitmanApplication;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Validation\ValidationException;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request)
    {
    // Capture email from input
    $email = $request->input('email');

    // 1. Check if they are rejected BEFORE processing standard auth checks
    $application = HitmanApplication::where('email', $email)->first();

    if ($application && $application->status === 'rejected') {
        throw ValidationException::withMessages([
            'email' => ['ACCESS DENIED: YOUR APPLICATION HAS BEEN PERMANENTLY REJECTED BY THE SYNDICATE.'],
        ]);
    }
    
    if ($application && $application->status === 'pending') {
        throw ValidationException::withMessages([
            'email' => ['ACCESS PENDING: CLASSIFIED PROFILE IS STILL UNDERGOING BACKGROUND EVALUATION.'],
        ]);
    }

    // 2. If not pending or rejected, continue to normal authentication logic
    $request->authenticate();
    $request->session()->regenerate();

    return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}

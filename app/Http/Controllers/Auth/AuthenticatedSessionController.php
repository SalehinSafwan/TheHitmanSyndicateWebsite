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
    // This logs the user in using Laravel's session guard (`web`).
    $request->authenticate();
    
    // Regenerating the session ID prevents Session Fixation attacks by making sure
    // a new unique identifier is issued to the browser upon successful login.
    $request->session()->regenerate();

    return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Log out the user from the 'web' session guard.
        Auth::guard('web')->logout();

        // Invalidate the current session and clear all attributes/payloads stored in the database.
        $request->session()->invalidate();

        // Regenerate the CSRF token to prevent one-click Cross-Site Request Forgery attacks
        // using the previously associated token signature.
        $request->session()->regenerateToken();

        return redirect('/');
    }
}

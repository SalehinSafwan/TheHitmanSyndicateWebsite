<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
{
    $user = $request->user();
    
    // 1. Capture the original codename before assigning the new one
    $oldCodename = $user->getOriginal('codename');
    
    DB::transaction(function () use ($request, $user, $oldCodename) {
        
        $user->codename = $request->validated('codename');
        $user->email = $request->validated('email');

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        // 2. Update the primary application linked by foreign key
        $user->hitmanApplication()->update([
            'codename' => $user->codename,
            'email'    => $user->email,
        ]);

        // 3. Update any rows where this operative was used as a referral
        if ($oldCodename) {
            DB::table('hitman_applications')
                ->where('referral_codename', $oldCodename)
                ->update(['referral_codename' => $user->codename]);
        }
    });

    return Redirect::route('profile.edit')->with('status', 'profile-updated');
}

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        // Perform cascading network records deletion 
        DB::transaction(function () use ($user) {
            $user->hitmanApplication()->delete();
            $user->delete();
        });

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
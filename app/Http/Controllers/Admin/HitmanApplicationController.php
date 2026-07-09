<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HitmanApplication;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class HitmanApplicationController extends Controller
{
    public function index(): View
    {
        return view('admin.hitman-applications.index', [
            'applications' => HitmanApplication::with(['reviewer', 'user'])->latest()->get(),
        ]);
    }

    public function approve(HitmanApplication $application): RedirectResponse
    {
        if ($application->status !== 'pending') {
            return back()->with('error', 'That request has already been reviewed.');
        }

        if (User::where('codename', $application->codename)->orWhere('email', $application->email)->exists()) {
            $application->update([
                'status' => 'rejected',
                'reviewed_by' => auth()->id(),
                'reviewed_at' => now(),
            ]);

            return back()->with('error', 'An account with that codename or email already exists.');
        }

        $user = DB::transaction(function () use ($application) {
            $user = User::create([
                'codename' => $application->codename,
                'specialty' => $application->specialty,
                'role' => 'Hitman',
                'email' => $application->email,
                'password' => $application->password,
            ]);

            $hitmanRole = Role::firstOrCreate(['name' => 'Hitman']);
            $user->roles()->syncWithoutDetaching($hitmanRole->id);

        
            $application->update([
                'status' => 'approved',
                'reviewed_by' => auth()->id(),
                'reviewed_at' => now(),
                'user_id' => $user->id,
            ]);

            return $user;
        }); 

        return back()->with('status', 'OPERATIVE ' . strtoupper($user->codename) . ' HAS BEEN APPROVED AND ACTIVATED.');
    }

    public function reject(HitmanApplication $application): RedirectResponse
    {
        if ($application->status !== 'pending') {
            return back()->with('error', 'That request has already been reviewed.');
        }

        $application->update([
            'status' => 'rejected',
            'reviewed_by' => auth()->id(),
            'reviewed_at' => now(),
        ]);

        //feedback message 
        return back()->with('error', 'APPLICATION DENIED. OPERATIVE ' . strtoupper($application->codename) . ' BLACKLISTED.');
    }
}
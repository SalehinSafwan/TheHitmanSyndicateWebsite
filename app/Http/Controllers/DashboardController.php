<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\Ledger;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; 

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        $user->load('hitmanApplication');

        // Query contracts: either assigned to this hitman, OR pending and unassigned
        $contracts = Contract::where('user_id', $user->id)
            ->orWhere(function ($query) {
                $query->whereNull('user_id')
                    ->where('status', 'pending');
            })->get();
        
        // Sum amounts from ledger where the associated contract is completed
        $totalEarnings = DB::table('ledger')
            ->join('contracts', 'ledger.contract_id', '=', 'contracts.id')
            ->where('ledger.hitman_id', $user->id)
            ->where('contracts.status', 'completed')
            ->sum('ledger.amount'); 
            
        $announcements = Announcement::latest()->take(5)->get();

        return view('dashboard', compact('contracts', 'totalEarnings', 'announcements'));
    }
}
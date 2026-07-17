<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\User;
use App\Models\Ledger;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): RedirectResponse
    {
        return redirect()->route('dashboard');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        // Only Admins can access the creation interface
        if (auth()->user()->role !== 'Admin') {
            abort(403, 'Unauthorized access.');
        }

        return view('admin.contracts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        // Only Admins can create contracts
        if (auth()->user()->role !== 'Admin') {
            abort(403, 'Unauthorized access.');
        }

        // Validate details according to the contracts database table
        $validated = $request->validate([
            'title'   => ['required', 'string', 'max:255'],
            'target'  => ['required', 'string', 'max:255'],
            'bounty'  => ['required', 'numeric', 'min:0'],
        ]);

        // Status defaults to 'pending' as defined in schema, user_id initialized as null
        Contract::create([
            'title'   => $validated['title'],
            'target'  => $validated['target'],
            'bounty'  => $validated['bounty'],
            'user_id' => null,
            'status'  => 'pending',
        ]);

        return redirect()
            ->route('admin.users.index')
            ->with('status', 'NEW CONTRACT INITIALIZED: AWAITING OPERATIVE ACCEPTANCE.');
    }

    /**
     * Accept the specified contract.
     */
    public function accept(Contract $contract): RedirectResponse
    {
        // Ensure contract is either unassigned (null) or already assigned to the active user
        if ($contract->user_id !== null && $contract->user_id !== auth()->id()) {
            abort(403, 'Unauthorized operation.');
        }

        // Ensure contract can only be accepted if it is currently pending
        if ($contract->status !== 'pending') {
            return back()->with('error', 'This contract cannot be accepted in its current state.');
        }

        // Update status to accepted and record the hitman's user ID (FK)
        $contract->update([
            'user_id' => auth()->id(),
            'status'  => 'accepted',
        ]);

        return back()->with('status', 'CONTRACT SIGNATURE AUTHORIZED: OPERATIVE SIGNED AND TARGET LOCKED.');
    }

    /**
     * Complete the specified contract and record details in the ledger.
     */
    public function complete(Contract $contract): RedirectResponse
    {
        // Ensure contract is assigned to the active user
        if ($contract->user_id !== auth()->id()) {
            abort(403, 'Unauthorized operation.');
        }

        // Ensure contract can only be completed if it is currently accepted
        if ($contract->status !== 'accepted') {
            return back()->with('error', 'This contract cannot be marked completed in its current state.');
        }

        // Update status to completed
        $contract->update([
            'status' => 'completed',
        ]);

        // Record bounty reward in the ledger
        Ledger::create([
            'contract_id' => $contract->id,
            'hitman_id'   => auth()->id(),
            'amount'      => $contract->bounty,
            'paid_at'     => now(),
        ]);

        return back()->with('status', 'CONTRACT COMPLETION CONFIRMED: OPERATIVE ACCOUNT CREDITED.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): RedirectResponse
    {
        return redirect()->route('dashboard');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): RedirectResponse
    {
        return redirect()->route('dashboard');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        return redirect()->route('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        return redirect()->route('dashboard');
    }
}

<?php

use App\Models\Contract;
use App\Models\User;

test('guest cannot access contract creation form', function () {
    $response = $this->get(route('admin.contracts.create'));
    $response->assertRedirect(route('login'));
});

test('non-admin cannot access contract creation form', function () {
    $user = User::factory()->create(['role' => 'Hitman']);
    $response = $this->actingAs($user)->get(route('admin.contracts.create'));
    $response->assertStatus(403);
});

test('admin can access contract creation form', function () {
    $admin = User::factory()->create(['role' => 'Admin']);
    $response = $this->actingAs($admin)->get(route('admin.contracts.create'));
    $response->assertStatus(200);
});

test('admin can deploy a new contract', function () {
    $admin = User::factory()->create(['role' => 'Admin']);

    $response = $this->actingAs($admin)->post(route('admin.contracts.store'), [
        'title' => 'Operation Kingmaker',
        'target' => 'Al-Ghazali',
        'bounty' => 50000.00,
    ]);

    $response->assertRedirect(route('admin.users.index'));
    $response->assertSessionHas('status', 'NEW CONTRACT INITIALIZED: AWAITING OPERATIVE ACCEPTANCE.');

    $this->assertDatabaseHas('contracts', [
        'title' => 'Operation Kingmaker',
        'target' => 'Al-Ghazali',
        'bounty' => 50000.00,
        'user_id' => null,
        'status' => 'pending',
    ]);
});

test('hitman can claim and accept an unassigned pending contract', function () {
    $hitman = User::factory()->create(['role' => 'Hitman']);
    $contract = Contract::forceCreate([
        'title' => 'Operation Showstopper',
        'target' => 'Viktor Novikov',
        'bounty' => 15000.00,
        'user_id' => null,
        'status' => 'pending',
    ]);

    $response = $this->actingAs($hitman)->post(route('contracts.accept', $contract));
    $response->assertRedirect();
    $response->assertSessionHas('status', 'CONTRACT SIGNATURE AUTHORIZED: OPERATIVE SIGNED AND TARGET LOCKED.');

    $this->assertEquals('accepted', $contract->refresh()->status);
    $this->assertEquals($hitman->id, $contract->refresh()->user_id);
});

test('hitman cannot accept contract assigned to someone else', function () {
    $hitman1 = User::factory()->create(['role' => 'Hitman']);
    $hitman2 = User::factory()->create(['role' => 'Hitman']);
    $contract = Contract::forceCreate([
        'title' => 'Operation Showstopper',
        'target' => 'Viktor Novikov',
        'bounty' => 15000.00,
        'user_id' => $hitman1->id,
        'status' => 'pending',
    ]);

    $response = $this->actingAs($hitman2)->post(route('contracts.accept', $contract));
    $response->assertStatus(403);
    $this->assertEquals('pending', $contract->refresh()->status);
});

test('hitman cannot accept non-pending contract', function () {
    $hitman = User::factory()->create(['role' => 'Hitman']);
    $contract = Contract::forceCreate([
        'title' => 'Operation Showstopper',
        'target' => 'Viktor Novikov',
        'bounty' => 15000.00,
        'user_id' => $hitman->id,
        'status' => 'accepted',
    ]);

    $response = $this->actingAs($hitman)->post(route('contracts.accept', $contract));
    $response->assertRedirect();
    $response->assertSessionHas('error', 'This contract cannot be accepted in its current state.');
});

test('hitman can mark accepted contract as completed and records bounty to ledger', function () {
    $hitman = User::factory()->create(['role' => 'Hitman']);
    $contract = Contract::forceCreate([
        'title' => 'Operation Showstopper',
        'target' => 'Viktor Novikov',
        'bounty' => 15000.00,
        'user_id' => $hitman->id,
        'status' => 'accepted',
    ]);

    $response = $this->actingAs($hitman)->post(route('contracts.complete', $contract));
    $response->assertRedirect();
    $response->assertSessionHas('status', 'CONTRACT COMPLETION CONFIRMED: OPERATIVE ACCOUNT CREDITED.');

    $this->assertEquals('completed', $contract->refresh()->status);
    $this->assertDatabaseHas('ledger', [
        'contract_id' => $contract->id,
        'hitman_id' => $hitman->id,
        'amount' => 15000.00,
    ]);
});

test('hitman cannot complete contract assigned to someone else', function () {
    $hitman1 = User::factory()->create(['role' => 'Hitman']);
    $hitman2 = User::factory()->create(['role' => 'Hitman']);
    $contract = Contract::forceCreate([
        'title' => 'Operation Showstopper',
        'target' => 'Viktor Novikov',
        'bounty' => 15000.00,
        'user_id' => $hitman1->id,
        'status' => 'accepted',
    ]);

    $response = $this->actingAs($hitman2)->post(route('contracts.complete', $contract));
    $response->assertStatus(403);
    $this->assertEquals('accepted', $contract->refresh()->status);
});

test('hitman cannot complete non-accepted contract', function () {
    $hitman = User::factory()->create(['role' => 'Hitman']);
    $contract = Contract::forceCreate([
        'title' => 'Operation Showstopper',
        'target' => 'Viktor Novikov',
        'bounty' => 15000.00,
        'user_id' => $hitman->id,
        'status' => 'pending',
    ]);

    $response = $this->actingAs($hitman)->post(route('contracts.complete', $contract));
    $response->assertRedirect();
    $response->assertSessionHas('error', 'This contract cannot be marked completed in its current state.');
    $this->assertEquals('pending', $contract->refresh()->status);
});

test('admin dashboard lists all contracts including pending, accepted, and completed ones', function () {
    $admin = User::factory()->create(['role' => 'Admin']);
    $hitman1 = User::factory()->create(['role' => 'Hitman']);
    $hitman2 = User::factory()->create(['role' => 'Hitman']);

    $contractPending = Contract::forceCreate([
        'title' => 'Pending Job',
        'target' => 'Target A',
        'bounty' => 5000,
        'user_id' => null,
        'status' => 'pending',
    ]);

    $contractAccepted = Contract::forceCreate([
        'title' => 'Accepted Job',
        'target' => 'Target B',
        'bounty' => 10000,
        'user_id' => $hitman1->id,
        'status' => 'accepted',
    ]);

    $contractCompleted = Contract::forceCreate([
        'title' => 'Completed Job',
        'target' => 'Target C',
        'bounty' => 15000,
        'user_id' => $hitman2->id,
        'status' => 'completed',
    ]);

    $response = $this->actingAs($admin)->get(route('dashboard'));
    $response->assertStatus(200);

    $responseContracts = $response->viewData('contracts');
    $this->assertCount(3, $responseContracts);
    $this->assertTrue($responseContracts->contains($contractPending));
    $this->assertTrue($responseContracts->contains($contractAccepted));
    $this->assertTrue($responseContracts->contains($contractCompleted));
});

test('hitman dashboard lists only unassigned pending contracts and their own accepted/completed contracts', function () {
    $hitman1 = User::factory()->create(['role' => 'Hitman']);
    $hitman2 = User::factory()->create(['role' => 'Hitman']);

    $unassignedPending = Contract::forceCreate([
        'title' => 'Unassigned Job',
        'target' => 'Target A',
        'bounty' => 5000,
        'user_id' => null,
        'status' => 'pending',
    ]);

    $ownAccepted = Contract::forceCreate([
        'title' => 'Own Accepted Job',
        'target' => 'Target B',
        'bounty' => 10000,
        'user_id' => $hitman1->id,
        'status' => 'accepted',
    ]);

    $ownCompleted = Contract::forceCreate([
        'title' => 'Own Completed Job',
        'target' => 'Target C',
        'bounty' => 15000,
        'user_id' => $hitman1->id,
        'status' => 'completed',
    ]);

    $otherAccepted = Contract::forceCreate([
        'title' => 'Other Accepted Job',
        'target' => 'Target D',
        'bounty' => 20000,
        'user_id' => $hitman2->id,
        'status' => 'accepted',
    ]);

    $response = $this->actingAs($hitman1)->get(route('dashboard'));
    $response->assertStatus(200);

    $responseContracts = $response->viewData('contracts');
    $this->assertCount(3, $responseContracts);
    $this->assertTrue($responseContracts->contains($unassignedPending));
    $this->assertTrue($responseContracts->contains($ownAccepted));
    $this->assertTrue($responseContracts->contains($ownCompleted));
    $this->assertFalse($responseContracts->contains($otherAccepted));
});

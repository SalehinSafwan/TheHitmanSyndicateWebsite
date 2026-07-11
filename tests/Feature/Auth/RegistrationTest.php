<?php

test('registration screen can be rendered', function () {
    $response = $this->get('/register');

    $response->assertStatus(200);
});

test('new users can submit registration application', function () {
    $response = $this->post('/register', [
        'codename' => 'HX-999',
        'specialty' => 'Infiltration',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'referral_codename' => 'HQ Direct Entry',
    ]);

    $this->assertGuest();
    $response->assertRedirect(route('login'));
    $response->assertSessionHas('status', 'CLASSIFIED TRANSMISSION RECEIVED. STAND BY FOR CLEARANCE.');

    $this->assertDatabaseHas('hitman_applications', [
        'codename' => 'HX-999',
        'email' => 'test@example.com',
        'status' => 'pending',
        'referral_codename' => 'HQ Direct Entry',
    ]);
});

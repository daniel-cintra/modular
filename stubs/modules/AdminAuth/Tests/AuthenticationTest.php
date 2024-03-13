<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\User\Models\User;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

test('login screen can be rendered', function () {
    $loginRoute = config('modular.login-url');

    $response = $this->get($loginRoute);

    $response->assertStatus(200);
});

test('users can authenticate using the login screen', function () {
    $user = User::factory()->create();

    $response = $this->post('/admin-auth/login', [
        'email' => $user->email,
        'password' => 'password',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect('/admin/dashboard');
});

test('users can not authenticate with invalid password', function () {
    $user = User::factory()->create();

    $this->post('/login', [
        'email' => $user->email,
        'password' => 'wrong-password',
    ]);

    $this->assertGuest();
});

test('users can logout', function () {
    $loginRoute = config('modular.login-url');
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get('/admin-auth/logout');

    $this->assertGuest();

    $response->assertRedirect($loginRoute);
});

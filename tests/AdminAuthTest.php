<?php

use Modular\Modular\User\Models\User;

it('blocks unauthenticated access to dashboard page', function () {
    $this->get(route('dashboard.index'))->assertRedirect(route('adminAuth.loginForm'));
});

it('allows authenticated access', function () {
    $this->withoutVite();
    $this->actingAs(User::factory()->create())->get(route('dashboard.index'))->assertOk();
});

it('can render login page', function () {
    $this->withoutVite();
    $this->get(route('adminAuth.loginForm'))->assertOk();
});

it('can login user', function () {
    $this->withoutVite();

    $user = User::factory()->create();

    $this->post(route('adminAuth.login'), [
        'email' => $user->email,
        'password' => 'password',
    ])->assertRedirectToRoute(config('modular.default-logged-route'));
});

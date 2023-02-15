<?php

use Modular\Modular\User\Models\User;

it('can render the dashboard page', function () {
    $this->withoutVite();
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get(route('dashboard.index'));

    $response->assertViewHas('page.component', 'Dashboard/DashboardIndex');
    $response->assertViewHas('page.url', '/dashboard');
    $response->assertViewHas('page.props.auth.user.name', $user->name);
    $response->assertViewHas('page.props.auth.user.email', $user->email);
});

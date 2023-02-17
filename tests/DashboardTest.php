<?php

use Modular\Modular\User\Models\User;
use function PHPUnit\Framework\assertEquals;

it('can render the dashboard page', function () {
    $this->withoutVite();
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get(route('dashboard.index'));

    $page = $response->viewData('page');
    $propUser = $page['props']['auth']['user'];

    assertEquals($page['component'], 'Dashboard/DashboardIndex');
    assertEquals($page['url'], '/dashboard');
    assertEquals($propUser['name'], $user->name);
    assertEquals($propUser['email'], $user->email);
});

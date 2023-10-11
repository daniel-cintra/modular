<?php

use Modular\Modular\User\Models\User;

use function PHPUnit\Framework\assertEquals;

it('can render the dashboard page', function () {
    $this->withoutVite();
    $user = User::factory()->create();

    $dashboardUrl = route(config('modular.default-logged-route'));
    $response = $this->actingAs($user)->get($dashboardUrl);

    $page = $response->viewData('page');
    $propUser = $page['props']['auth']['user'];

    assertEquals($page['component'], 'Dashboard/DashboardIndex');
    assertEquals($page['url'], '/dashboard');
    assertEquals($propUser['name'], $user->name);
    assertEquals($propUser['email'], $user->email);
});

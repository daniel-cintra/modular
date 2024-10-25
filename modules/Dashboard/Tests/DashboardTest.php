<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;
use Modules\User\Models\User;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->loggedRequest = $this->actingAs($this->user);
});

it('can render the dashboard page', function () {
    $dashboardUrl = route(config('modular.default-logged-route'));
    $response = $this->loggedRequest->get($dashboardUrl);

    $response->assertStatus(200);

    $response->assertInertia(
        fn (Assert $page) => $page
            ->component('Dashboard/DashboardIndex')
            ->has(
                'auth.user',
                fn (Assert $page) => $page
                    ->where('id', $this->user->id)
                    ->where('name', $this->user->name)
                    ->etc()
            )
            ->has(
                'auth.permissions',
            )
            ->has(
                'errors',
            )
            ->has(
                'flash',
                2,
            )
            ->has(
                'ziggy.routes',
            )
    );
});

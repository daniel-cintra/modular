<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;
use Modules\User\Models\User;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->loggedRequest = $this->actingAs($this->user);

    $this->role = Role::create(['name' => 'root', 'guard_name' => 'user']);
    $this->role2 = Role::create(['name' => 'second', 'guard_name' => 'user']);

    $this->user->syncRoles([$this->role->id]);
});

test('user roles can be rendered', function () {
    $response = $this->loggedRequest->get('/admin/acl-user-role/'.$this->user->id.'/edit');

    $response->assertStatus(200);

    $response->assertInertia(
        fn (Assert $page) => $page
            ->component('AclUserRole/UserRoleForm')
            ->has(
                'user',
                fn (Assert $page) => $page
                    ->where('id', $this->user->id)
                    ->etc()
            )
            ->has(
                'user.roles',
                1,
                fn (Assert $page) => $page
                    ->where('id', $this->role->id)
                    ->where('name', $this->role->name)
            )
            ->has(
                'roles',
                2
            )
    );
});

test('user roles can be updated', function () {
    $response = $this->loggedRequest->put('/admin/acl-user-role/'.$this->user->id, [
        'userRoles' => [$this->role2->id],
    ]);

    $response->assertRedirect('/admin/user');

    $user = User::with(['roles' => function ($q) {
        $q->get(['id', 'name']);
    }])->findOrFail($this->user->id);

    $this->assertCount(1, $user->roles);
    $this->assertFalse($user->hasRole($this->role->name));
    $this->assertTrue($user->hasRole($this->role2->name));
});

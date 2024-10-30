<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;
use Modules\User\Models\User;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

beforeEach(function () {
    $this->role = Role::create(['name' => 'root']);
    $this->user = User::factory()->create();

    $this->user->assignRole($this->role);
    $this->loggedRequest = $this->actingAs($this->user);
});

test('role list can be rendered', function () {
    $response = $this->loggedRequest->get('/admin/acl-role');

    $response->assertStatus(200);

    $response->assertInertia(
        fn (Assert $page) => $page
            ->component('AclRole/RoleIndex')
            ->has(
                'roles.data',
                1,
                fn (Assert $page) => $page
                    ->where('id', $this->role->id)
                    ->where('name', $this->role->name)
                    ->where('guard_name', $this->role->guard_name)
            )
    );
});

test('role can be created', function () {
    $response = $this->loggedRequest->post('/admin/acl-role', [
        'name' => 'Role Name',
    ]);

    $roles = Role::all();

    $this->assertCount(2, $roles);
    $this->assertEquals('Role Name', $roles->last()->name);

    $response->assertRedirect('/admin/acl-role');
});

test('role edit can be rendered', function () {
    $response = $this->loggedRequest->get('/admin/acl-role/'.$this->role->id.'/edit');

    $response->assertStatus(200);

    $response->assertInertia(
        fn (Assert $page) => $page
            ->component('AclRole/RoleForm')
            ->has(
                'role',
                fn (Assert $page) => $page
                    ->where('id', $this->role->id)
                    ->where('name', $this->role->name)
                    ->where('guard_name', $this->role->guard_name)
                    ->etc()
            )
    );
});

test('role can be updated', function () {
    $response = $this->loggedRequest->put('/admin/acl-role/'.$this->role->id, [
        'name' => 'z Role Name',
    ]);

    $response->assertRedirect('/admin/acl-role');

    $redirectResponse = $this->loggedRequest->get('/admin/acl-role');
    $redirectResponse->assertInertia(
        fn (Assert $page) => $page
            ->component('AclRole/RoleIndex')
            ->has(
                'roles.data',
                1,
                fn (Assert $page) => $page
                    ->where('id', $this->role->id)
                    ->where('name', 'z Role Name')
                    ->where('guard_name', $this->role->guard_name)
            )
    );
});

test('role can be deleted', function () {
    $response = $this->loggedRequest->delete('/admin/acl-role/'.$this->role->id);

    $response->assertRedirect('/admin/acl-role');

    $this->assertCount(0, Role::all());
});

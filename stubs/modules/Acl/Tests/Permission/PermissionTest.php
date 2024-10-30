<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;
use Modules\User\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

beforeEach(function () {
    $role = Role::create(['name' => 'root']);
    $this->permission = Permission::create(['name' => 'first']);

    $this->user = User::factory()->create();
    $this->user->assignRole($role);

    $this->loggedRequest = $this->actingAs($this->user);
});

test('permission list can be rendered', function () {
    $response = $this->loggedRequest->get('/admin/acl-permission');

    $response->assertStatus(200);

    $response->assertInertia(
        fn (Assert $page) => $page
            ->component('AclPermission/PermissionIndex')
            ->has(
                'permissions.data',
                1,
                fn (Assert $page) => $page
                    ->where('id', $this->permission->id)
                    ->where('name', $this->permission->name)
                    ->where('guard', null)
            )
    );
});

test('permission can be created', function () {
    $response = $this->loggedRequest->post('/admin/acl-permission', [
        'name' => 'Permission Name',
    ]);

    $permissions = Permission::all();

    $this->assertCount(2, $permissions);
    $this->assertEquals('Permission Name', $permissions->last()->name);
    $response->assertRedirect('/admin/acl-permission');
});

test('permission edit can be rendered', function () {
    $response = $this->loggedRequest->get('/admin/acl-permission/'.$this->permission->id.'/edit');

    $response->assertStatus(200);

    $response->assertInertia(
        fn (Assert $page) => $page
            ->component('AclPermission/PermissionForm')
            ->has(
                'permission',
                fn (Assert $page) => $page
                    ->where('id', $this->permission->id)
                    ->where('name', $this->permission->name)
                    ->where('guard_name', $this->permission->guard_name)
                    ->where('created_at', $this->permission->created_at->toISOString())
                    ->where('updated_at', $this->permission->updated_at->toISOString())
            )
    );
});

test('permission can be updated', function () {
    $response = $this->loggedRequest->put('/admin/acl-permission/'.$this->permission->id, [
        'name' => 'z Permission Name',
    ]);

    $response->assertRedirect('/admin/acl-permission');

    $redirectResponse = $this->loggedRequest->get('/admin/acl-permission');
    $redirectResponse->assertInertia(
        fn (Assert $page) => $page
            ->component('AclPermission/PermissionIndex')
            ->has(
                'permissions.data',
                1,
                fn (Assert $page) => $page
                    ->where('id', $this->permission->id)
                    ->where('name', 'z Permission Name')
                    ->where('guard', null)
            )
    );
});

test('permission can be deleted', function () {
    $response = $this->loggedRequest->delete('/admin/acl-permission/'.$this->permission->id);

    $response->assertRedirect('/admin/acl-permission');

    $this->assertCount(0, Permission::all());
});

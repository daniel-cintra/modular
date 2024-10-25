<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Acl\Services\GetUserPermissions;
use Modules\User\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();

    $this->role = Role::create(['name' => 'role 1', 'guard_name' => 'user']);
    $this->role2 = Role::create(['name' => 'role 2', 'guard_name' => 'user']);

    $this->permission = Permission::create(['name' => 'permission 1', 'guard_name' => 'user']);
    $this->permission2 = Permission::create(['name' => 'permission 2', 'guard_name' => 'user']);
});

test('user permission service returns correct direct permissions for the user', function () {
    $this->user->syncPermissions([$this->permission->id]);

    $userPermissions = (new GetUserPermissions)->run($this->user->id);

    $this->assertCount(1, $userPermissions);
    $this->assertEquals($this->permission->id, $userPermissions[0]['id']);
});

test('user permission service returns correct empty permissions for the user', function () {
    $userPermissions = (new GetUserPermissions)->run($this->user->id);

    $this->assertTrue(is_array($userPermissions));
    $this->assertCount(0, $userPermissions);
});

test('user permission service returns correct role permissions for the user', function () {
    $this->role2->syncPermissions([$this->permission2->id]);
    $this->user->syncRoles([$this->role2->id]);

    $userPermissions = (new GetUserPermissions)->run($this->user->id);

    $this->assertCount(1, $userPermissions);
    $this->assertEquals($this->permission2->id, $userPermissions[0]['id']);
});

test('user permission service returns correct direct and role permissions for the user', function () {
    $this->user->syncPermissions([$this->permission->id]);
    $this->role2->syncPermissions([$this->permission2->id]);
    $this->user->syncRoles([$this->role2->id]);

    $userPermissions = (new GetUserPermissions)->run($this->user->id);

    //granular user permissions, will always override role permissions for the user
    $this->assertCount(1, $userPermissions);
    $this->assertEquals($this->permission->id, $userPermissions[0]['id']);
});

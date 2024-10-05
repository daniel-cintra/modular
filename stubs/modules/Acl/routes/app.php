<?php

use Illuminate\Support\Facades\Route;
use Modules\Acl\Http\Controllers\PermissionController;
use Modules\Acl\Http\Controllers\RoleController;
use Modules\Acl\Http\Controllers\RolePermissionController;
use Modules\Acl\Http\Controllers\UserController;
use Modules\Acl\Http\Controllers\UserPermissionController;
use Modules\Acl\Http\Controllers\UserRoleController;

//acl
Route::get('acl/get-user-roles-and-permissions', [
    UserController::class, 'getUserRolesAndPermissions',
]);

//acl - permission
Route::get('acl-permission', [
    PermissionController::class, 'index',
])->name('aclPermission.index')
    ->can('Acl: Permission - List');

Route::get('acl-permission/create', [
    PermissionController::class, 'create',
])->name('aclPermission.create')
    ->can('Acl: Permission - Create');

Route::post('acl-permission', [
    PermissionController::class, 'store',
])->name('aclPermission.store')
    ->can('Acl: Permission - Create');

Route::get('acl-permission/{id}/edit', [
    PermissionController::class, 'edit',
])->name('aclPermission.edit')
    ->can('Acl: Permission - Edit');

Route::put('acl-permission/{id}', [
    PermissionController::class, 'update',
])->name('aclPermission.update')
    ->can('Acl: Permission - Edit');

Route::delete('acl-permission/{id}', [
    PermissionController::class, 'destroy',
])->name('aclPermission.destroy')
    ->can('Acl: Permission - Delete');

//acl - role
Route::get('acl-role', [
    RoleController::class, 'index',
])->name('aclRole.index')
    ->can('Acl: Role - List');

Route::get('acl-role/create', [
    RoleController::class, 'create',
])->name('aclRole.create')
    ->can('Acl: Role - Create');

Route::post('acl-role', [
    RoleController::class, 'store',
])->name('aclRole.store')
    ->can('Acl: Role - Create');

Route::get('acl-role/{id}/edit', [
    RoleController::class, 'edit',
])->name('aclRole.edit')
    ->can('Acl: Role - Edit');

Route::put('acl-role/{id}', [
    RoleController::class, 'update',
])->name('aclRole.update')
    ->can('Acl: Role - Edit');

Route::delete('acl-role/{id}', [
    RoleController::class, 'destroy',
])->name('aclRole.destroy')
    ->can('Acl: Role - Delete');

//acl - role => permissions
Route::get('acl-role-permission/{id}/edit', [
    RolePermissionController::class, 'edit',
])->name('aclRolePermission.edit')
    ->can('Acl: Role: Permission - Edit');

Route::put('acl-role-permission/{id}', [
    RolePermissionController::class, 'update',
])->name('aclRolePermission.update')
    ->can('Acl: Role: Permission - Edit');

//acl - user role
Route::get('acl-user-role/{id}/edit', [
    UserRoleController::class, 'edit',
])->name('aclUserRole.edit')
    ->can('Acl: User: Role - Edit');

Route::put('acl-user-role/{id}', [
    UserRoleController::class, 'update',
])->name('aclUserRole.update')
    ->can('Acl: User: Role - Edit');

//acl - user => permissions
Route::get('acl-user-permission/{id}/edit', [
    UserPermissionController::class, 'edit',
])->name('aclUserPermission.edit')
    ->can('Acl: User: Permission - Edit');

Route::put('acl-user-permission/{id}', [
    UserPermissionController::class, 'update',
])->name('aclUserPermission.update')
    ->can('Acl: User: Permission - Edit');

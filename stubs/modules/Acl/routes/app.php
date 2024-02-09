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
])->name('aclPermission.index');

Route::get('acl-permission/create', [
    PermissionController::class, 'create',
])->name('aclPermission.create');

Route::post('acl-permission', [
    PermissionController::class, 'store',
])->name('aclPermission.store');

Route::get('acl-permission/{id}/edit', [
    PermissionController::class, 'edit',
])->name('aclPermission.edit');

Route::put('acl-permission/{id}', [
    PermissionController::class, 'update',
])->name('aclPermission.update');

Route::delete('acl-permission/{id}', [
    PermissionController::class, 'destroy',
])->name('aclPermission.destroy');

//acl - role
Route::get('acl-role', [
    RoleController::class, 'index',
])->name('aclRole.index');

Route::get('acl-role/create', [
    RoleController::class, 'create',
])->name('aclRole.create');

Route::post('acl-role', [
    RoleController::class, 'store',
])->name('aclRole.store');

Route::get('acl-role/{id}/edit', [
    RoleController::class, 'edit',
])->name('aclRole.edit');

Route::put('acl-role/{id}', [
    RoleController::class, 'update',
])->name('aclRole.update');

Route::delete('acl-role/{id}', [
    RoleController::class, 'destroy',
])->name('aclRole.destroy');

//acl - role => permissions
Route::get('acl-role-permission/{id}/edit', [
    RolePermissionController::class, 'edit',
])->name('aclRolePermission.edit');

Route::put('acl-role-permission/{id}', [
    RolePermissionController::class, 'update',
])->name('aclRolePermission.update');

//acl - user role
Route::get('acl-user-role/{id}/edit', [
    UserRoleController::class, 'edit',
])->name('aclUserRole.edit');

Route::put('acl-user-role/{id}', [
    UserRoleController::class, 'update',
])->name('aclUserRole.update');

//acl - user => permissions
Route::get('acl-user-permission/{id}/edit', [
    UserPermissionController::class, 'edit',
])->name('aclUserPermission.edit');

Route::put('acl-user-permission/{id}', [
    UserPermissionController::class, 'update',
])->name('aclUserPermission.update');

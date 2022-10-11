<?php

use Illuminate\Support\Facades\Route;

//acl
Route::get('acl/get-user-roles-and-permissions', [
    'uses' => 'UserController@getUserRolesAndPermissions',
]);

//acl - permission
Route::get('acl-permission', [
    'uses' => 'PermissionController@index',
])->name('aclPermission.index');

Route::get('acl-permission/create', [
    'uses' => 'PermissionController@create',
])->name('aclPermission.create');

Route::post('acl-permission', [
    'uses' => 'PermissionController@store',
])->name('aclPermission.store');

Route::get('acl-permission/{id}/edit', [
    'uses' => 'PermissionController@edit',
])->name('aclPermission.edit');

Route::put('acl-permission/{id}', [
    'uses' => 'PermissionController@update',
])->name('aclPermission.update');

Route::delete('acl-permission/{id}', [
    'uses' => 'PermissionController@destroy',
])->name('aclPermission.destroy');

//acl - role
Route::get('acl-role', [
    'uses' => 'RoleController@index',
])->name('aclRole.index');

Route::get('acl-role/create', [
    'uses' => 'RoleController@create',
])->name('aclRole.create');

Route::post('acl-role', [
    'uses' => 'RoleController@store',
])->name('aclRole.store');

Route::get('acl-role/{id}/edit', [
    'uses' => 'RoleController@edit',
])->name('aclRole.edit');

Route::put('acl-role/{id}', [
    'uses' => 'RoleController@update',
])->name('aclRole.update');

Route::delete('acl-role/{id}', [
    'uses' => 'RoleController@destroy',
])->name('aclRole.destroy');

//acl - role => permissions
Route::get('acl-role-permission/{id}/edit', [
    'uses' => 'RolePermissionController@edit',
])->name('aclRolePermission.edit');

Route::put('acl-role-permission/{id}', [
    'uses' => 'RolePermissionController@update',
])->name('aclRolePermission.update');

//acl - user role
Route::get('acl-user-role/{id}/edit', [
    'uses' => 'UserRoleController@edit',
])->name('aclUserRole.edit');

Route::put('acl-user-role/{id}', [
    'uses' => 'UserRoleController@update',
])->name('aclUserRole.update');

//acl - user => permissions
Route::get('acl-user-permission/{id}/edit', [
    'uses' => 'UserPermissionController@edit',
])->name('aclUserPermission.edit');

Route::put('acl-user-permission/{id}', [
    'uses' => 'UserPermissionController@update',
])->name('aclUserPermission.update');

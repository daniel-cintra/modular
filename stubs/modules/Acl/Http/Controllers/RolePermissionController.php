<?php

namespace Modules\Acl\Http\Controllers;

use Modules\Support\Http\Controllers\BackendController;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionController extends BackendController
{
    public function edit($id)
    {
        $role = Role::with(['permissions' => function ($q) {
            $q->get(['id', 'name']);
        }])->findOrFail($id);

        $role->permissions->map(function ($permission) {
            unset($permission->pivot);

            return $permission;
        });

        $permissions = Permission::orderBy('name')->get(['id', 'name']);

        return inertia('AclRolePermission/RolePermissionForm', [
            'role' => $role,
            'permissions' => $permissions,
        ]);
    }

    public function update($id)
    {
        $role = Role::findOrFail($id);

        $role->syncPermissions(request('rolePermissions'));

        return redirect()->route('aclRole.index')
            ->with('success', 'Role permissions updated');
    }
}

<?php

namespace Modules\Acl\Http\Controllers;

use Modules\Acl\Services\GetUserPermissions;
use Modules\Support\Http\Controllers\BackendController;
use Modules\User\Models\User;
use Spatie\Permission\Models\Permission;

class UserPermissionController extends BackendController
{
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $userPermissions = (new GetUserPermissions)->run($id);

        $permissions = Permission::orderBy('name')->get(['id', 'name']);

        return inertia('AclUserPermission/UserPermissionForm', [
            'user' => $user,
            'userPermissions' => $userPermissions,
            'permissions' => $permissions,
        ]);
    }

    public function update($id)
    {
        $user = User::findOrFail($id);

        $user->syncPermissions(request('userPermissions'));

        return redirect()->route('user.index')
            ->with('success', 'User permissions updated');
    }
}

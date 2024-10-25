<?php

namespace Modules\Acl\Http\Controllers;

use Modules\Acl\Http\Requests\PermissionValidate;
use Modules\Support\Http\Controllers\BackendController;
use Spatie\Permission\Models\Permission;

class PermissionController extends BackendController
{
    public function index()
    {
        $searchTerm = request('searchTerm');
        $permissions = Permission::when($searchTerm, function ($query, $searchTerm) {
            $query->where(request('searchContext'), 'like', "%{$searchTerm}%");
        })
            ->orderBy('guard_name')
            ->orderBy('name')
            ->paginate(request('rowsPerPage', 10))
            ->withQueryString()
            ->through(fn ($permission) => [
                'id' => $permission->id,
                'name' => $permission->name,
                'guard' => $permission->guard,

            ]);

        return inertia('AclPermission/PermissionIndex', [
            'permissions' => $permissions,
        ]);
    }

    public function create()
    {
        return inertia('AclPermission/PermissionForm');
    }

    public function store(PermissionValidate $request)
    {
        $params = $request->validated();
        $params['guard_name'] = 'user';
        Permission::create($params);

        return redirect()->route('aclPermission.index')
            ->with('success', 'Permission created');
    }

    public function edit($id)
    {
        $permission = Permission::find($id);

        return inertia('AclPermission/PermissionForm', [
            'permission' => $permission,
        ]);
    }

    public function update(PermissionValidate $request, $id)
    {
        $permission = Permission::findOrFail($id);

        $permission->update($request->validated());

        return redirect()->route('aclPermission.index')
            ->with('success', 'Permission updated');
    }

    public function destroy($id)
    {
        Permission::findOrFail($id)->delete();

        return redirect()->route('aclPermission.index')
            ->with('success', 'Permission deleted');
    }
}

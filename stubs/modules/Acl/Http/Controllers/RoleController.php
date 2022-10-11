<?php

namespace Modules\Acl\Http\Controllers;

use Modules\Support\Http\Controllers\BackendController;
use Spatie\Permission\Models\Role;
use Modules\Acl\Http\Requests\RoleValidate;

class RoleController extends BackendController
{
    public function index()
    {
        $searchTerm = request('searchTerm');
        $roles = Role::when($searchTerm, function ($query, $searchTerm) {
            $query->where(request('searchContext'), 'like', "%{$searchTerm}%");
        })
            ->orderBy('name')
            ->paginate(request('rowsPerPage', 10))
            ->withQueryString()
            ->through(function ($role) {
                return [
                    'id' => $role->id,
                    'name' => $role->name,
                    'guard_name' => $role->guard_name,
                ];
            });

        return inertia('AclRole/RoleIndex', [
            'roles' => $roles
        ]);
    }

    public function create()
    {
        return inertia('AclRole/RoleForm');
    }

    public function store(RoleValidate $request)
    {
        $params = $request->validated();
        $params['guard_name'] = 'user';
        Role::create($params);

        return redirect()->route('aclRole.index')
            ->with('success', 'Role saved');
    }

    public function edit($id)
    {
        $role = Role::find($id);

        return inertia('AclRole/RoleForm', [
            'role' => $role
        ]);
    }

    public function update(RoleValidate $request, $id)
    {
        $role = Role::findOrFail($id);

        $role->update($request->validated());

        return redirect()->route('aclRole.index')
            ->with('success', 'Role saved');
    }

    public function destroy($id)
    {
        Role::findOrFail($id)->delete();

        return redirect()->route('aclRole.index')
            ->with('success', 'Role deleted');
    }
}

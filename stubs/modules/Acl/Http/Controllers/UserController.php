<?php

namespace Modules\Acl\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Support\Http\Controllers\BackendController;
use Modules\User\Models\User;

class UserController extends BackendController
{
    public function index()
    {
        $users = User::with('roles')->orderBy('name')->get();

        return compact('users');
    }

    public function getUserRolesAndPermissions(Request $request)
    {
        $user = auth()->guard('user')->user();

        return [
            'userRoles' => $user->getRoleNames(),
            'userPermissions' => $user->getPermissionsViaRoles()->pluck('name'),
        ];
    }
}

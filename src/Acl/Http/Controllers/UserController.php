<?php

namespace Modular\Modular\Acl\Http\Controllers;

use Illuminate\Http\Request;
use Modular\Modular\Http\Controllers\BackendController;
use Modular\Modular\User\Models\User;

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

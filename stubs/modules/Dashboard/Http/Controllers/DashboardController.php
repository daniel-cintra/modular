<?php

namespace Modules\Dashboard\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Modules\Support\Http\Controllers\BackendController;

class DashboardController extends BackendController
{
    /**
     * Display the dashboard view.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        $count = [
            'users' => User::count(),
            'permissions' => Permission::count(),
            'roles' => Role::count(),
        ];

        return Inertia::render('Dashboard/DashboardIndex', [
            'count' => $count
        ]);
    }
}

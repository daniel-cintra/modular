<?php

namespace Modules\Dashboard\Http\Controllers;

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
        return inertia('Dashboard/DashboardIndex');
    }
}

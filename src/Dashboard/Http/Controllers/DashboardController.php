<?php

namespace Modular\Modular\Dashboard\Http\Controllers;

use Inertia\Inertia;
use Modular\Modular\Http\Controllers\BackendController;

class DashboardController extends BackendController
{
    /**
     * Display the dashboard view.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        return Inertia::render('Dashboard/DashboardIndex');
    }
}

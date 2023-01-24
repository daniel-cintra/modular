<?php

namespace Modular\Modular\Dashboard;

use Modular\Modular\BaseServiceProvider;

class DashboardServiceProvider extends BaseServiceProvider
{
    /**
     * This namespace is applied to the controller routes in your routes file.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'Modular\Modular\Dashboard\Http\Controllers';

    /**
     * Bootstrap the module events.
     */
    public function boot()
    {
        parent::boot();
    }
}

<?php

namespace Modules\Dashboard;

use Modules\Support\BaseServiceProvider;

class DashboardServiceProvider extends BaseServiceProvider
{
    /**
     * This namespace is applied to the controller routes in your routes file.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'Modules\Dashboard\Http\Controllers';

    /**
     * Bootstrap the module events.
     */
    public function boot()
    {
        parent::boot();
    }
}

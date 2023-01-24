<?php

namespace Modular\Modular\AdminAuth;

use Modular\Modular\BaseServiceProvider;

class AdminAuthServiceProvider extends BaseServiceProvider
{
    /**
     * This namespace is applied to the controller routes in your routes file.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'Modular\Modular\AdminAuth\Http\Controllers';

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/views', 'admin-auth');
        parent::boot();
    }
}

<?php

namespace Modular\Modular\Acl;

use Modular\Modular\BaseServiceProvider;

class AclServiceProvider extends BaseServiceProvider
{
    /**
     * This namespace is applied to the controller routes in your routes file.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'Modular\Modular\Acl\Http\Controllers';

    /**
     * Bootstrap the application events.
     */
    public function boot()
    {
        $this->mergeConfigFrom(__DIR__.'/config/config.php', 'acl');
        parent::boot();
    }
}

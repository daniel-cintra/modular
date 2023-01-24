<?php

namespace Modular\Modular\User;

use Modular\Modular\BaseServiceProvider;
use Modular\Modular\User\Models\User;
use Modular\Modular\User\Observers\UserObserver;

class UserServiceProvider extends BaseServiceProvider
{
    /**
     * This namespace is applied to the controller routes in your routes file.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'Modular\Modular\User\Http\Controllers';

    /**
     * Bootstrap the application events.
     */
    public function boot()
    {
        parent::boot();

        User::observe(UserObserver::class);
    }
}

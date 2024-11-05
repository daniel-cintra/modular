<?php

namespace Modules\User;

use Illuminate\Database\Eloquent\Relations\Relation;
use Modules\Support\BaseServiceProvider;
use Modules\User\Console\Commands\CreateUserCommand;
use Modules\User\Models\User;
use Modules\User\Observers\UserObserver;

class UserServiceProvider extends BaseServiceProvider
{
    /**
     * This namespace is applied to the controller routes in your routes file.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'Modules\User\Http\Controllers';

    /**
     * Bootstrap the application events.
     */
    public function boot()
    {
        parent::boot();

        $this->loadMigrationsFrom(__DIR__.'/Database/Migrations');

        Relation::morphMap([
            'user' => User::class,
        ]);

        User::observe(UserObserver::class);

        $this->commands([
            CreateUserCommand::class,
        ]);
    }
}

<?php

namespace Modular\Modular\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Filesystem\Filesystem;
use Modular\Modular\Acl\AclServiceProvider;
use Modular\Modular\AdminAuth\AdminAuthServiceProvider;
use Modular\Modular\Dashboard\DashboardServiceProvider;
use Modular\Modular\ModularServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Modular\\Modular\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );

        copy(__DIR__.'/../stubs/config/auth.php', base_path('config/auth.php'));
        (new Filesystem)->copyDirectory(__DIR__.'/../stubs/resources', base_path('resources'));

        (new Filesystem)->ensureDirectoryExists(base_path('modules'));
    }

    protected function resolveApplicationHttpKernel($app)
    {
        $app->singleton('Illuminate\Contracts\Http\Kernel', 'Modular\Modular\Tests\Overrides\Http\Kernel');
    }

    protected function getPackageProviders($app)
    {
        return [
            AclServiceProvider::class,
            AdminAuthServiceProvider::class,
            DashboardServiceProvider::class,
            ModularServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        $migration = include __DIR__.'/../database/migrations/create_users_table.php.stub';
        $migration->up();

        $migration = include __DIR__.'/../database/migrations/add_custom_fields_to_users_table.php.stub';
        $migration->up();
    }
}

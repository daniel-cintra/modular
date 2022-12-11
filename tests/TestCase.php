<?php

namespace Modular\Modular\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modular\Modular\ModularServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;
use Illuminate\Filesystem\Filesystem;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Modular\\Modular\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );

        (new Filesystem)->ensureDirectoryExists(base_path('modules'));
    }

    protected function getPackageProviders($app)
    {
        return [
            ModularServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        /*
        $migration = include __DIR__.'/../database/migrations/create_modular_table.php.stub';
        $migration->up();
        */
    }
}

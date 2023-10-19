<?php

namespace Modular\Modular\Tests;

use Illuminate\Filesystem\Filesystem;
use Modular\Modular\ModularServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        (new Filesystem)->ensureDirectoryExists(base_path('modules'));
        (new Filesystem)->copyDirectory(__DIR__.'/../stubs/resources', base_path('resources'));
    }

    protected function getPackageProviders($app)
    {
        return [
            ModularServiceProvider::class,
        ];
    }
}

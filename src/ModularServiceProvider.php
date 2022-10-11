<?php

namespace Modular\Modular;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Modular\Modular\Console\InstallCommand;

class ModularServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('modular')
            ->hasConfigFile()
            ->hasViews()
            ->hasCommand(InstallCommand::class);
    }
}

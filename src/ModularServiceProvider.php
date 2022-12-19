<?php

namespace Modular\Modular;

use Modular\Modular\Console\InstallCommand;
use Modular\Modular\Console\MakeControllerCommand;
use Modular\Modular\Console\MakeModelCommand;
use Modular\Modular\Console\MakeModuleCommand;
use Modular\Modular\Console\MakeRouteCommand;
use Modular\Modular\Console\MakeValidateCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

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
            ->hasCommand(InstallCommand::class)
            ->hasCommand(MakeModuleCommand::class)
            ->hasCommand(MakeControllerCommand::class)
            ->hasCommand(MakeValidateCommand::class)
            ->hasCommand(MakeModelCommand::class)
            ->hasCommand(MakeRouteCommand::class);
    }
}

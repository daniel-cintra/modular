<?php

namespace Modular\Modular;

use Modular\Modular\Console\InstallCommand;
use Modular\Modular\Console\MakeControllerCommand;
use Modular\Modular\Console\MakeModelCommand;
use Modular\Modular\Console\MakeModuleCommand;
use Modular\Modular\Console\MakePageCommand;
use Modular\Modular\Console\MakeRouteCommand;
use Modular\Modular\Console\MakeServiceCommand;
use Modular\Modular\Console\MakeValidateCommand;
use Modular\Modular\Console\MakeServiceCommand;
use Modular\Modular\Console\MakePageCommand;
use Modular\Modular\Console\MakeComposableCommand;
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
            ->hasCommand(MakeRouteCommand::class)
            ->hasCommand(MakeServiceCommand::class)
            ->hasCommand(MakePageCommand::class)
            ->hasCommand(MakeComposableCommand::class);
    }
}

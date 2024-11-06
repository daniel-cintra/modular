<?php

namespace Modular\Modular\Console;

use Illuminate\Console\Command;
use Modular\Modular\Console\InstallerTraits\BackendPackages;
use Modular\Modular\Console\InstallerTraits\CoreModules;
use Modular\Modular\Console\InstallerTraits\FrontendPackages;
use Modular\Modular\Console\InstallerTraits\PestTests;
use Symfony\Component\Process\PhpExecutableFinder;

class InstallCommand extends Command
{
    use BackendPackages, CoreModules, FrontendPackages, PestTests;

    protected $signature = 'modular:install {--composer=global : Absolute path to the Composer binary which should be used to install packages}';

    protected $description = 'Install the Modular required resources';

    public function handle(): int
    {
        $this->components->info('Installing required stacks...');

        $this->setupBackendPackages();

        $this->installFrontendPackages();

        $this->components->info('Required stacks installed!');

        $this->configureCoreModules();

        $this->setupPestTests();

        $this->info('🎉 Modular successfully installed!');

        $this->info('🚀 To create your first user, please run: php artisan modular:create-user');

        return self::SUCCESS;
    }

    protected function phpBinary(): string
    {
        return (new PhpExecutableFinder)->find(false) ?: 'php';
    }
}

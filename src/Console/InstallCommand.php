<?php

namespace Modular\Modular\Console;

use Illuminate\Console\Command;
use Symfony\Component\Process\PhpExecutableFinder;

class InstallCommand extends Command
{
    use BackendPackages, FrontendPackages, SupportModules;

    protected $signature = 'modular:install {--composer=global : Absolute path to the Composer binary which should be used to install packages}';

    protected $description = 'Install the Modular required resources';

    /**
     * Execute the console command.
     *
     * @return int|null
     */
    public function handle()
    {
        $this->comment('Migrating database...');
        $this->call('migrate');
        $this->comment('Database.migrated!');

        $this->comment('Installing required stacks...');

        $this->installBackendPackages();

        $this->installFrontendPackages();

        $this->comment('Required stacks.installed!');

        $this->configureSupportModules();

        return self::SUCCESS;
    }

    /**
     * Get the path to the appropriate PHP binary.
     *
     * @return string
     */
    protected function phpBinary()
    {
        return (new PhpExecutableFinder())->find(false) ?: 'php';
    }
}

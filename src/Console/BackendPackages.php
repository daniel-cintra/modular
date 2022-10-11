<?php

namespace Modular\Modular\Console;

use Symfony\Component\Process\Process;

trait BackendPackages
{
    /**
     * Install the Composer dependencies.
     *
     * @return void
     */
    protected function installBackendPackages()
    {
        $this->components->info('Installing composer packages...');

        $this->requireComposerPackages(
            'inertiajs/inertia-laravel:^0.6.3',
            'laravel/sanctum:^2.8',
            'spatie/laravel-activitylog:^4.5',
            'spatie/laravel-permission:^5.5',
            'tightenco/ziggy:^1.0'
        );

        $this->publishVendorFiles();

        $this->components->info('Composer packages installed successfully!');
    }

    protected function publishVendorFiles()
    {
        (new Process([$this->phpBinary(), 'artisan', 'vendor:publish', '--provider=Spatie\Permission\PermissionServiceProvider'], base_path()))
            ->setTimeout(null)
            ->run(function ($type, $output) {
                $this->output->write($output);
            });

        (new Process([$this->phpBinary(), 'artisan', 'config:clear'], base_path()))
            ->setTimeout(null)
            ->run(function ($type, $output) {
                $this->output->write($output);
            });

        (new Process([$this->phpBinary(), 'artisan', 'vendor:publish', '--provider=Spatie\Activitylog\ActivitylogServiceProvider', '--tag=activitylog-migrations'], base_path()))
            ->setTimeout(null)
            ->run(function ($type, $output) {
                $this->output->write($output);
            });

        (new Process([$this->phpBinary(), 'artisan', 'vendor:publish', '--provider=Spatie\Activitylog\ActivitylogServiceProvider', '--tag=activitylog-config'], base_path()))
            ->setTimeout(null)
            ->run(function ($type, $output) {
                $this->output->write($output);
            });
    }

    // protected function publishVendorFiles()
    // {
    //     // spatie/laravel-permission
    //     $this->call('vendor:publish', [
    //         '--provider' => 'Spatie\Permission\PermissionServiceProvider'
    //     ]);
    //     $this->call('config:clear');

    //     // spatie/laravel-activitylog
    //     $this->call('vendor:publish', [
    //         '--provider' => 'Spatie\Activitylog\ActivitylogServiceProvider',
    //         '--tag' => 'activitylog-migrations',
    //     ]);

    //     $this->call('vendor:publish', [
    //         '--provider' => 'Spatie\Activitylog\ActivitylogServiceProvider',
    //         '--tag' => 'activitylog-config',
    //     ]);
    // }

    /**
     * Installs the given Composer Packages into the application.
     *
     * @param  mixed  $packages
     * @return void
     */
    protected function requireComposerPackages($packages)
    {
        $composer = $this->option('composer');

        if ($composer !== 'global') {
            $command = ['php', $composer, 'require'];
        }

        $command = array_merge(
            $command ?? ['composer', 'require'],
            is_array($packages) ? $packages : func_get_args()
        );

        // $process = new Process($command, base_path(), ['COMPOSER_MEMORY_LIMIT' => '-1']);
        // $process->setTimeout(null);
        // $process->start();

        // while ($process->isRunning()) {
        //     $this->output->write($process->getOutput());
        // }

        // $process->wait();

        // $this->comment('Composer install finalizado...');
        // $this->publishVendorFiles();

        (new Process($command, base_path(), ['COMPOSER_MEMORY_LIMIT' => '-1']))
            ->setTimeout(null)
            ->run(function ($type, $output) {
                $this->output->write($output);
            });
    }
}

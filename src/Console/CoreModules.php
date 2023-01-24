<?php

namespace Modular\Modular\Console;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use Symfony\Component\Process\Process;

trait CoreModules
{
    /**
     * Install the Composer dependencies.
     *
     * @return void
     */
    protected function configureCoreModules()
    {
        $this->configureMiddlewares();

        $this->copyResources();

        $this->configureModulesDirectory();

        copy(__DIR__.'/../../stubs/routes/web.php', base_path('routes/web.php'));

        copy(__DIR__.'/../../stubs/config/auth.php', base_path('config/auth.php'));

        copy(__DIR__.'/../../stubs/public/favicon.svg', public_path('favicon.svg'));

        $this->setupDatabase();
        $this->seedDatabase();
        $this->runCommands(['npm run build']);

        $this->line('');
        $this->components->info('Core Modules configured!');
    }

    private function configureMiddlewares(): void
    {
        $this->components->info('Configuring Middlewares...');
        copy(__DIR__.'/../../stubs/app/Http/Middleware/HandleInertiaRequests.php', app_path('Http/Middleware/HandleInertiaRequests.php'));
        $this->installMiddlewareAfter('SubstituteBindings::class', '\App\Http\Middleware\HandleInertiaRequests::class');
        $this->installRouteMiddlewareAfter('EnsureEmailIsVerified::class', "'auth.user' => \Modular\Modular\AdminAuth\Http\Middleware\UserAuth::class");
    }

    private function copyResources(): void
    {
        $this->components->info('Copying resources directory...');
        (new Filesystem)->ensureDirectoryExists(base_path('resources'));
        (new Filesystem)->copyDirectory(__DIR__.'/../../stubs/resources', base_path('resources'));
    }

    private function configureModulesDirectory(): void
    {
        $this->components->info('Configuring modules autoload...');

        // Modules...
        (new Filesystem)->ensureDirectoryExists(base_path('modules'));

        $this->configureAutoload('"database/seeders/"', '"Modules\\\": "modules/"');

        $this->dumpAutoload();
    }

    /**
     * Run the php artisan migrate command.
     *
     * @return void
     */
    protected function setupDatabase()
    {
        (new Filesystem)->copyDirectory(__DIR__.'/../../stubs/database/seeders', base_path('database/seeders'));

        $this->call('vendor:publish', [
            '--tag' => 'modular-migrations',
        ]);

        (new Process([$this->phpBinary(), 'artisan', 'migrate'], base_path()))
            ->setTimeout(null)
            ->run(function ($type, $output) {
                $this->output->write($output);
            });
    }

    /**
     * Run the php artisan db:seed command.
     *
     * @return void
     */
    protected function seedDatabase()
    {
        (new Process([$this->phpBinary(), 'artisan', 'db:seed'], base_path()))
            ->setTimeout(null)
            ->run(function ($type, $output) {
                $this->output->write($output);
            });
    }

    /**
     * Configure PSR-4 autoload for the "modules" path.
     *
     * @param  string  $after
     * @param  string  $path
     * @return void
     */
    protected function configureAutoload($after, $path)
    {
        $composerContent = file_get_contents(base_path('composer.json'));

        $psr4Autoloads = Str::before(Str::after($composerContent, '"autoload":'), '},');

        if (! Str::contains($psr4Autoloads, $path)) {
            $modifiedAutoload = str_replace(
                $after,
                $after.','.PHP_EOL.'            '.$path,
                $psr4Autoloads,
            );

            file_put_contents(base_path('composer.json'), str_replace(
                $psr4Autoloads,
                $modifiedAutoload,
                $composerContent
            ));
        }
    }

    /**
     * Run composer dump-autoload command.
     *
     * @return void
     */
    protected function dumpAutoload()
    {
        $composer = $this->option('composer');

        if ($composer !== 'global') {
            $command = ['php', $composer, 'dump-autoload'];
        } else {
            $command = ['composer', 'dump-autoload'];
        }

        (new Process($command, base_path()))
            ->setTimeout(null)
            ->run(function ($type, $output) {
                $this->output->write($output);
            });
    }

    /**
     * Install the middleware to a group in the application Http Kernel.
     *
     * @param  string  $after
     * @param  string  $name
     * @param  string  $group
     * @return void
     */
    protected function installMiddlewareAfter($after, $name, $group = 'web')
    {
        $httpKernel = file_get_contents(app_path('Http/Kernel.php'));

        $middlewareGroups = Str::before(Str::after($httpKernel, '$middlewareGroups = ['), '];');
        $middlewareGroup = Str::before(Str::after($middlewareGroups, "'$group' => ["), '],');

        if (! Str::contains($middlewareGroup, $name)) {
            $modifiedMiddlewareGroup = str_replace(
                $after.',',
                $after.','.PHP_EOL.'            '.$name.',',
                $middlewareGroup,
            );

            file_put_contents(app_path('Http/Kernel.php'), str_replace(
                $middlewareGroups,
                str_replace($middlewareGroup, $modifiedMiddlewareGroup, $middlewareGroups),
                $httpKernel
            ));
        }
    }

    /**
     * Install the middleware to a group in the application Http Kernel.
     *
     * @param  string  $after
     * @param  string  $name
     * @param  string  $group
     * @return void
     */
    protected function installRouteMiddlewareAfter($after, $name)
    {
        $httpKernel = file_get_contents(app_path('Http/Kernel.php'));

        $routeMiddlewares = Str::before(Str::after($httpKernel, '$routeMiddleware = ['), '];');

        if (! Str::contains($routeMiddlewares, $name)) {
            $modifiedRoutedMiddlewares = str_replace(
                $after.',',
                $after.','.PHP_EOL.PHP_EOL.'        '.$name.',',
                $routeMiddlewares,
            );

            file_put_contents(app_path('Http/Kernel.php'), str_replace(
                $routeMiddlewares,
                $modifiedRoutedMiddlewares,
                $httpKernel
            ));
        }
    }
}

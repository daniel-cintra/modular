<?php

namespace Modular\Modular\Console;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use Symfony\Component\Process\Process;

trait SupportModules
{
    /**
     * Install the Composer dependencies.
     *
     * @return void
     */
    protected function configureSupportModules()
    {
        $this->components->info('Configuring support modules...');

        $this->configureAutoload('"database/seeders/"', '"Modules\\\": "modules/"');

        $this->components->info('Dumping autoload...');
        $this->dumpAutoload();

        // Modules...
        (new Filesystem)->ensureDirectoryExists(base_path('modules'));
        (new Filesystem)->copyDirectory(__DIR__ . '/../../stubs/modules', base_path('modules'));

        // Middlewares...
        copy(__DIR__ . '/../../stubs/app/Http/Middleware/HandleInertiaRequests.php', app_path('Http/Middleware/HandleInertiaRequests.php'));
        $this->installMiddlewareAfter('SubstituteBindings::class', '\App\Http\Middleware\HandleInertiaRequests::class');
        $this->installRouteMiddlewareAfter('EnsureEmailIsVerified::class', "'auth.user' => \Modules\AdminAuth\Http\Middleware\UserAuth::class");

        // Resources...
        (new Filesystem)->ensureDirectoryExists(base_path('resources'));
        (new Filesystem)->copyDirectory(__DIR__ . '/../../stubs/resources', base_path('resources'));

        // Routes...
        copy(__DIR__ . '/../../stubs/routes/web.php', base_path('routes/web.php'));

        // Database...
        (new Filesystem)->ensureDirectoryExists(base_path('database/factories'));
        copy(__DIR__ . '/../../stubs/database/factories/UserFactory.php', base_path('database/factories/UserFactory.php'));
        copy(__DIR__ . '/../../stubs/database/seeders/DatabaseSeeder.php', base_path('database/seeders/DatabaseSeeder.php'));

        // Auth...
        copy(__DIR__ . '/../../stubs/config/auth.php', base_path('config/auth.php'));

        $this->registerServiceProviders();

        $this->migrateDatabase();
        $this->seedDatabase();
        $this->runCommands(['npm run build']);

        $this->line('');
        $this->components->info('Support modules configured!');
    }

    /**
     * Run the php artisan migrate command.
     * 
     * @return void
     */
    protected function migrateDatabase()
    {
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

        if (!Str::contains($psr4Autoloads, $path)) {
            $modifiedAutoload = str_replace(
                $after,
                $after . ',' . PHP_EOL . '            ' . $path,
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

        if (!Str::contains($middlewareGroup, $name)) {
            $modifiedMiddlewareGroup = str_replace(
                $after . ',',
                $after . ',' . PHP_EOL . '            ' . $name . ',',
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

        if (!Str::contains($routeMiddlewares, $name)) {
            $modifiedRoutedMiddlewares = str_replace(
                $after . ',',
                $after . ',' . PHP_EOL . PHP_EOL . '        ' . $name . ',',
                $routeMiddlewares,
            );

            file_put_contents(app_path('Http/Kernel.php'), str_replace(
                $routeMiddlewares,
                $modifiedRoutedMiddlewares,
                $httpKernel
            ));
        }
    }

    /**
     * Register the Modules Service Providers.
     * 
     * @return void
     */
    protected function registerServiceProviders()
    {
        $this->replaceInFile(
            '        App\Providers\RouteServiceProvider::class,',
            $this->getModulesProviders(),
            config_path('app.php')
        );
    }

    /**
     * Replace a given string within a given file.
     *
     * @param  string  $search
     * @param  string  $replace
     * @param  string  $path
     * @return void
     */
    protected function replaceInFile($search, $replace, $path)
    {
        file_put_contents($path, str_replace($search, $replace, file_get_contents($path)));
    }

    /**
     * Get the service providers string to be used in config/app.php file.
     * 
     * @return string
     */
    protected function getModulesProviders()
    {
        return <<<'EOT'
                App\Providers\RouteServiceProvider::class,

                /*
                * Modules Service Providers...
                */
                Modules\Support\SupportServiceProvider::class,
                Modules\AdminAuth\AdminAuthServiceProvider::class,
                Modules\User\UserServiceProvider::class,
                Modules\Dashboard\DashboardServiceProvider::class,
                Modules\Acl\AclServiceProvider::class,
        EOT;
    }
}

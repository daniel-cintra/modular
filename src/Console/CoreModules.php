<?php

namespace Modular\Modular\Console;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use Symfony\Component\Process\Process;

trait CoreModules
{
    protected function configureCoreModules(): void
    {
        $this->configureMiddlewares();

        $this->call('vendor:publish', [
            '--tag' => 'modular-translations',
        ]);

        $this->copyResources();

        $this->copyModules();
        $this->configureModulesProviders();

        $this->configureModulesAutoload();

        copy(__DIR__.'/../../stubs/routes/web.php', base_path('routes/web.php'));

        copy(__DIR__.'/../../stubs/config/auth.php', base_path('config/auth.php'));

        copy(__DIR__.'/../../stubs/public/favicon.svg', public_path('favicon.svg'));

        $this->migrateDatabase();
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
        $this->installAliasMiddlewareAfter('EnsureEmailIsVerified::class', "'auth.user' => \Modules\AdminAuth\Http\Middleware\UserAuth::class");
    }

    private function copyResources(): void
    {
        $this->components->info('Copying resources directory...');
        (new Filesystem)->ensureDirectoryExists(base_path('resources'));
        (new Filesystem)->copyDirectory(__DIR__.'/../../stubs/resources', base_path('resources'));
    }

    private function configureModulesAutoload(): void
    {
        $this->components->info('Configuring modules autoload...');

        // Modules...
        (new Filesystem)->ensureDirectoryExists(base_path('modules'));

        $this->configureAutoload('"database/seeders/"', '"Modules\\\": "modules/"');

        $this->dumpAutoload();
    }

    private function copyModules(): void
    {
        $this->components->info('Copying modules directory...');
        (new Filesystem)->ensureDirectoryExists(base_path('modules'));
        (new Filesystem)->copyDirectory(__DIR__.'/../../stubs/modules', base_path('modules'));
    }

    protected function migrateDatabase(): void
    {
        (new Process([$this->phpBinary(), 'artisan', 'migrate'], base_path()))
            ->setTimeout(null)
            ->run(function ($type, $output) {
                $this->output->write($output);
            });
    }

    protected function seedDatabase(): void
    {
        (new Process([$this->phpBinary(), 'artisan', 'db:seed', '--class=Modules\User\Database\Seeders\UserSeeder'], base_path()))
        ->setTimeout(null)
        ->run(function ($type, $output) {
            $this->output->write($output);
        });
    }

    protected function configureModulesProviders(): void
    {
        $configAppFile = base_path('config/app.php');

        // Read the content of the file
        $content = file_get_contents($configAppFile);

        // Define the string to be added
        $providersToAdd = PHP_EOL.PHP_EOL
            ."        Modules\Support\SupportServiceProvider::class,".PHP_EOL
            ."        Modules\AdminAuth\AdminAuthServiceProvider::class,".PHP_EOL
            ."        Modules\User\UserServiceProvider::class,".PHP_EOL
            ."        Modules\Dashboard\DashboardServiceProvider::class,".PHP_EOL
            ."        Modules\Acl\AclServiceProvider::class,".PHP_EOL;

        // Find the position after which you want to add the new service providers
        $searchString = "App\Providers\RouteServiceProvider::class,";

        // Use the Str helper to replace
        $modifiedContent = Str::replaceFirst($searchString, $searchString.$providersToAdd, $content);

        // Write the modified content back to the file
        file_put_contents($configAppFile, $modifiedContent);
    }

    protected function configureAutoload(string $after, string $path): void
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

    protected function dumpAutoload(): void
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

    protected function installMiddlewareAfter(string $after, string $name, string $group = 'web'): void
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

    protected function installAliasMiddlewareAfter(string $after, string $name): void
    {
        $httpKernel = file_get_contents(app_path('Http/Kernel.php'));

        $middlewareAliases = Str::before(Str::after($httpKernel, '$middlewareAliases = ['), '];');

        if (! Str::contains($middlewareAliases, $name)) {
            $modifiedAliasedMiddlewares = str_replace(
                $after.',',
                $after.','.PHP_EOL.PHP_EOL.'        '.$name.',',
                $middlewareAliases,
            );

            file_put_contents(app_path('Http/Kernel.php'), str_replace(
                $middlewareAliases,
                $modifiedAliasedMiddlewares,
                $httpKernel
            ));
        }
    }
}

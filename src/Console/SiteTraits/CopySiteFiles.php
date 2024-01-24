<?php

namespace Modular\Modular\Console\SiteTraits;

use Illuminate\Filesystem\Filesystem;

trait CopySiteFiles
{
    private function copySupportModuleFiles(): void
    {
        $this->info('Copying Support Module files...');

        copy(__DIR__.'/../../../stubs/site/modules/Support/SiteController.php', base_path('modules/Support/Http/Controllers/SiteController.php'));
        copy(__DIR__.'/../../../stubs/site/modules/Support/SiteModel.php', base_path('modules/Support/Models/SiteModel.php'));

        $this->info('Support Module files copied.');
    }

    private function copyResourcesSiteDir(): void
    {
        $this->info('Copying resources-site directory...');

        (new Filesystem)->ensureDirectoryExists(base_path('resources-site'));
        (new Filesystem)->copyDirectory(__DIR__.'/../../../stubs/site/resources-site', base_path('resources-site'));

        $this->info('The resources-site directory was copied.');
    }

    private function copyIndexModuleDir(): void
    {
        $this->info('Copying Index Module directory...');

        (new Filesystem)->ensureDirectoryExists(base_path('modules/Index'));
        (new Filesystem)->copyDirectory(__DIR__.'/../../../stubs/site/modules/Index', base_path('modules/Index'));

        $this->info('The Index Module directory was copied.');
    }
}

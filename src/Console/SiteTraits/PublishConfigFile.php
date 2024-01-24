<?php

namespace Modular\Modular\Console\SiteTraits;

trait PublishConfigFile
{
    private function publishModularConfigFile(): void
    {
        if (file_exists(config_path('modular.php'))) {
            $this->info('The Modular config file already exists. Moving on...');
        } else {
            $this->call('vendor:publish', [
                '--tag' => 'modular-config',
            ]);
        }
    }
}

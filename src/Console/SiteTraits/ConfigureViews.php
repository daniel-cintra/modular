<?php

namespace Modular\Modular\Console\SiteTraits;

trait ConfigureViews
{
    private function configureViews(): void
    {
        $configViewFilePath = config_path('view.php');

        if (file_exists($configViewFilePath)) {
            $this->info('Setting config/view.php...');

            $viewConfig = file_get_contents($configViewFilePath);

            $strSearch = "resource_path('views'),";
            $strReplace = "resource_path('views'),".PHP_EOL."        base_path('resources-site/views'),";

            $updatedViewConfig = str_replace(
                $strSearch,
                $strReplace,
                $viewConfig
            );

            file_put_contents($configViewFilePath, $updatedViewConfig);

            $this->info('The config/view.php file was updated.');
        } else {
            $this->info('The config/view.php file does not exist.');
        }
    }
}

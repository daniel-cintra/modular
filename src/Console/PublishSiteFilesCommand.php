<?php

namespace Modular\Modular\Console;

use Illuminate\Console\Command;
use Modular\Modular\Console\SiteTraits\ConfigureViews;
use Modular\Modular\Console\SiteTraits\CopySiteFiles;
use Modular\Modular\Console\SiteTraits\PublishConfigFile;

class PublishSiteFilesCommand extends Command
{
    use ConfigureViews, CopySiteFiles, PublishConfigFile;

    protected $signature = 'modular:publish-site-files';

    protected $description = 'Publishes the site files to use Modular as a base for a public site';

    public function handle(): ?int
    {
        $this->publishModularConfigFile();

        $this->copySupportModuleFiles();
        $this->copyIndexModuleDir();

        $this->copyResourcesSiteDir();

        $this->configureViews();

        return self::SUCCESS;
    }
}

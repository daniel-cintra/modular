<?php

namespace Modular\Modular\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class PublishTranslationsCommand extends Command
{
    protected $signature = 'modular:publish-translations {--lang=}';

    protected $description = 'Publishes Laravel native\' translation file for the given language';

    protected string $lang;

    /**
     * Execute the console command.
     *
     * @return int|null
     */
    public function handle()
    {
        $lang = $this->option('lang');

        $availableLangs = ['pt_BR'];

        if (! in_array($lang, $availableLangs)) {
            $this->error("The language '{$lang}' is not available. Available languages: ".implode(', ', $availableLangs));

            return self::FAILURE;
        }

        $this->publishLang($lang);

        return self::SUCCESS;
    }

    private function publishLang(string $lang): void
    {
        $filesystem = new Filesystem();

        $filesystem->copyDirectory(
            __DIR__."/../../stubs/lang/{$lang}",
            lang_path("{$lang}")
        );

        $this->info("The language files for '{$lang}' were published successfully.");
    }
}

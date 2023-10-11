<?php

namespace Modules\Support\Traits;

use Illuminate\Filesystem\Filesystem;

trait PublishModuleTranslations
{
    public function modularLangFileExists(string $lang): bool
    {
        $langFile = $this->getLangFile($lang);

        if (! file_exists($langFile)) {
            return false;
        }

        return true;
    }

    public function publishModuleTranslations(string $lang, string $moduleTranslationsFile): bool
    {
        $langFile = $this->getLangFile($lang);

        if (is_file($moduleTranslationsFile)) {
            $modularCoreTranslations = (new Filesystem)->get($langFile);
            $modularCoreTranslations = str_replace("\n}\n", ",\n", $modularCoreTranslations);

            $moduleTranslations = (new Filesystem)->get($moduleTranslationsFile);
            $moduleTranslations = str_replace('{', '', $moduleTranslations);

            (new Filesystem)->put($langFile, $modularCoreTranslations.$moduleTranslations);

            return true;
        } else {
            return false;
        }
    }

    protected function getLangFile(string $lang): string
    {
        return base_path("lang/vendor/modular/{$lang}/{$lang}.json");
    }
}

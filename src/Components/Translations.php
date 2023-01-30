<?php

namespace Modular\Modular\Components;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Illuminate\View\Component;

class Translations extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $locale = app()->getLocale();

        $modularTranslationsPath = lang_path("vendor/modular/$locale");
        $modularTranslations = $this->getPHPTranslations($modularTranslationsPath);

        $appTranslationsPath = lang_path($locale);
        $appTranslations = $this->getPHPTranslations($appTranslationsPath);

        $jsonTranslationFile = lang_path("$locale/$locale.json");
        if (File::exists($jsonTranslationFile)) {
            $jsonTranslations = json_decode(File::get($jsonTranslationFile), true);
        }

        if (isset($jsonTranslations)) {
            $translations = array_merge($modularTranslations, $appTranslations, $jsonTranslations);
        } else {
            $translations = array_merge($modularTranslations, $appTranslations);
        }

        return view('components.translations', [
            'translations' => $translations,
        ]);
    }

    private function getPHPTranslations(string $directory): array
    {
        return collect(File::allFiles($directory))
            ->filter(function ($file) {
                return $file->getExtension() === 'php';
            })->flatMap(function ($file) {
                return Arr::dot(File::getRequire($file->getRealPath()));
            })->toArray();
    }
}

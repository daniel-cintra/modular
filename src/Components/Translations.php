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

        if (app()->environment('production')) {
            $translations = cache()->rememberForever("translations_$locale", fn() => $this->getTranslations($locale));
        } else {
            $translations = $this->getTranslations($locale);
        }

        return view('components.translations', [
            'translations' => $translations,
        ]);
    }

    private function getTranslations(string $locale): array
    {
        $appPHPTranslations = $this->getPHPTranslations(lang_path($locale));

        $appJsonTranslations = $this->getJsonTranslations(lang_path("$locale/$locale.json"));
        $modularJsonTranslations = $this->getJsonTranslations(lang_path("vendor/modular/$locale/$locale.json"));

        return array_merge($appPHPTranslations, $appJsonTranslations, $modularJsonTranslations);
    }

    private function getPHPTranslations(string $directory): array
    {
        if (! is_dir($directory)) {
            return [];
        }

        return collect(File::allFiles($directory))
            ->filter(fn($file) => $file->getExtension() === 'php')->flatMap(fn($file) => Arr::dot(File::getRequire($file->getRealPath())))->toArray();
    }

    private function getJsonTranslations(string $filePath): array
    {
        if (File::exists($filePath)) {
            return json_decode(File::get($filePath), true, 512, JSON_THROW_ON_ERROR);
        } else {
            return [];
        }
    }
}

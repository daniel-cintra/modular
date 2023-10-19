<?php

use Illuminate\Filesystem\Filesystem;

beforeEach(function () {
    $this->artisan('modular:make-module ModuleName');
});

afterEach(function () {
    (new Filesystem)->deleteDirectory(base_path('modules'));
    (new Filesystem)->deleteDirectory(resource_path('js/Pages'));
});

it('can run modular:make-composable command', function () {
    $this->artisan('modular:make-composable moduleName composableName')->assertSuccessful();
});

it('can generate a composable file', function () {
    $this->artisan('modular:make-composable moduleName composableName');

    $composable = resource_path('js/Pages/ModuleName/Composables/useComposableName.js');
    $this->assertTrue(file_exists($composable));

    $composableContent = file_get_contents($composable);

    expect($composableContent)->toContain('export default function useComposableName() {');
    expect($composableContent)->toContain('return { composableName }');
});

<?php

use Illuminate\Filesystem\Filesystem;

beforeEach(function () {
    $this->artisan('modular:make-module ModuleName');
});

afterEach(function () {
    (new Filesystem)->deleteDirectory(base_path('modules'));
    (new Filesystem)->deleteDirectory(resource_path('js/Pages'));
});

it('can run modular:make-component command', function () {
    $this->artisan('modular:make-component moduleName componentName')->assertSuccessful();
});

it('can generate a component for the module', function () {
    $this->artisan('modular:make-component moduleName componentName');

    $component = resource_path('js/Pages/ModuleName/Components/ComponentName.vue');
    $this->assertTrue(file_exists($component));

    $componentContent = file_get_contents($component);

    expect($componentContent)->toContain('<template>');
    expect($componentContent)->toContain('<script setup>');
});

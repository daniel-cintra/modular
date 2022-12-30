<?php

use Illuminate\Filesystem\Filesystem;

beforeEach(function () {
    $this->artisan('modular:make-module ModuleName');
});

afterEach(function () {
    (new Filesystem)->deleteDirectory(base_path('modules'));
    (new Filesystem)->deleteDirectory(resource_path('js/Pages'));
});

it('can run modular:make-page command', function () {
    $this->artisan('modular:make-page moduleName resourceName')->assertSuccessful();
});

it('can generate an index page', function () {
    $this->artisan('modular:make-page moduleName resourceName');

    $page = resource_path('js/Pages/ModuleName/ResourceNameIndex.vue');
    $this->assertTrue(file_exists($page));

    $pageContent = file_get_contents($page);

    expect($pageContent)->toContain('<AppSectionHeader title="ResourceNames" :bread-crumb="breadCrumb">');
});

it('can generate a form page', function () {
    $this->artisan('modular:make-page moduleName resourceName');

    $page = resource_path('js/Pages/ModuleName/ResourceNameForm.vue');
    $this->assertTrue(file_exists($page));

    $pageContent = file_get_contents($page);

    expect($pageContent)->toContain('<AppSectionHeader title="ResourceNames" :bread-crumb="breadCrumb">');
});

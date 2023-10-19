<?php

use Illuminate\Filesystem\Filesystem;

beforeEach(function () {
    $this->artisan('modular:make-module ModuleName');
});

afterEach(function () {
    (new Filesystem)->deleteDirectory(base_path('modules'));
});

it('can run modular:make-controller command', function () {
    $this->artisan('modular:make-controller moduleName resourceName')->assertSuccessful();
});

it('can generate a controller', function () {
    $this->artisan('modular:make-controller moduleName resourceName');

    $controller = base_path('modules/ModuleName/Http/Controllers/ResourceNameController.php');
    $this->assertTrue(file_exists($controller));

    $controllerContent = file_get_contents($controller);

    expect($controllerContent)->toContain('namespace Modules\ModuleName\Http\Controllers;');
    expect($controllerContent)->toContain('class ResourceNameController extends BackendController');
});

<?php

use Illuminate\Filesystem\Filesystem;

beforeEach(function () {
    $this->artisan('modular:make-module ModuleName');
});

afterEach(function () {
    (new Filesystem)->deleteDirectory(base_path('modules'));
});

it('can run modular:make-model command', function () {
    $this->artisan('modular:make-model moduleName resourceName')->assertSuccessful();
});

it('can generate a model', function () {
    $this->artisan('modular:make-model moduleName resourceName');

    $model = base_path('modules/ModuleName/Models/ResourceName.php');
    $this->assertTrue(file_exists($model));

    $modelContent = file_get_contents($model);

    expect($modelContent)->toContain('namespace Modules\ModuleName\Models;');
    expect($modelContent)->toContain('class ResourceName extends BaseModel');
    expect($modelContent)->toContain('protected $table = resourceNames;');
});

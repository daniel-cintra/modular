<?php

use Illuminate\Filesystem\Filesystem;

beforeEach(function () {
    $this->artisan('modular:make-module ModuleName');
});

afterEach(function () {
    (new Filesystem)->deleteDirectory(base_path('modules'));
});

it('can run modular:make-validate command', function () {
    $this->artisan('modular:make-validate moduleName resourceName')->assertSuccessful();
});

it('can generate a validate file', function () {
    $this->artisan('modular:make-validate moduleName resourceName');

    $validate = base_path('modules/ModuleName/Http/Requests/ResourceNameValidate.php');
    $this->assertTrue(file_exists($validate));

    $validateContent = file_get_contents($validate);

    expect($validateContent)->toContain('namespace Modules\ModuleName\Http\Requests;');
    expect($validateContent)->toContain('class ResourceNameValidate extends Request');
});

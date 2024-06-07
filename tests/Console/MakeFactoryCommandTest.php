<?php

use Illuminate\Filesystem\Filesystem;

afterEach(function () {
    (new Filesystem)->deleteDirectory(base_path('modules'));
});

it('can run modular:make-factory command', function () {
    $this->artisan('modular:make-factory moduleName moduleName')->assertSuccessful();
});

it('can set the factory name', function () {
    $this->artisan('modular:make-factory moduleName moduleName')->expectsOutput('Creating Module FactoryName');
});

it('can create the module Service Provider', function () {
    $this->artisan('modular:make-factory moduleName moduleName');
    $this->assertTrue(file_exists(base_path('modules/ModuleName/ModuleNameServiceProvider.php')));
});

it('can create the module directory structure', function () {
    $this->artisan('modular:make-module moduleName');

    expect(base_path('modules/ModuleName'))->toBeDirectory();

    expect(base_path('modules/ModuleName/Database'))->toBeDirectory();
    expect(base_path('modules/ModuleName/Database/Migrations'))->toBeDirectory();
    expect(base_path('modules/ModuleName/Database/Factories'))->toBeDirectory();

    expect(base_path('modules/ModuleName/Http'))->toBeDirectory();
    expect(base_path('modules/ModuleName/Http/Controllers'))->toBeDirectory();
    expect(base_path('modules/ModuleName/Http/Requests'))->toBeDirectory();

    expect(base_path('modules/ModuleName/Models'))->toBeDirectory();
    expect(base_path('modules/ModuleName/routes'))->toBeDirectory();
    expect(base_path('modules/ModuleName/Tests'))->toBeDirectory();
});

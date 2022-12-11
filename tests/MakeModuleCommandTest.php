<?php

use Illuminate\Filesystem\Filesystem;

afterEach(function () {
    (new Filesystem)->deleteDirectory(base_path('modules'));
});

// it('can run modular:install command', function () {
//     $this->artisan('modular:install')->assertSuccessful();
// });

it('can run modular:make-module command', function () {
    $this->artisan('modular:make-module moduleName')->assertSuccessful();
});

it('can set the module name', function () {
    $this->artisan('modular:make-module moduleName')->expectsOutput('Creating Module ModuleName');
});

it('can create the module\'s directory', function () {
    $this->artisan('modular:make-module moduleName');
    expect(base_path('modules/ModuleName'))->toBeDirectory();
});

it('can create the module\'s Service Provider', function () {
    $this->artisan('modular:make-module moduleName');
    $this->assertTrue(file_exists(base_path('modules/ModuleName/ModuleNameServiceProvider.php')));
});

it('can create the module\'s http directory structure', function () {
    $this->artisan('modular:make-module moduleName');
    expect(base_path('modules/ModuleName/Http'))->toBeDirectory();
    expect(base_path('modules/ModuleName/Http/Controllers'))->toBeDirectory();
    expect(base_path('modules/ModuleName/Http/Requests'))->toBeDirectory();
});

it('can create the module\'s Controller', function () {
    $this->artisan('modular:make-module moduleName');
    $this->assertTrue(file_exists(base_path('modules/ModuleName/Http/Controllers/ModuleNameController.php')));
});

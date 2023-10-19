<?php

use Illuminate\Filesystem\Filesystem;

beforeEach(function () {
    $this->artisan('modular:make-module ModuleName');
});

afterEach(function () {
    (new Filesystem)->deleteDirectory(base_path('modules'));
});

it('can run modular:make-route command', function () {
    $this->artisan('modular:make-route moduleName resourceName')->assertSuccessful();
});

it('can generate a route', function () {
    $this->artisan('modular:make-route moduleName resourceName');

    $route = base_path('modules/ModuleName/routes/app.php');
    $this->assertTrue(file_exists($route));

    $routeContent = file_get_contents($route);

    expect($routeContent)->toContain('use Illuminate\Support\Facades\Route;');
    expect($routeContent)->toContain('Route::get(\'resource-name\'');
    expect($routeContent)->toContain('\'uses\' => \'ResourceNameController@index\',');
});

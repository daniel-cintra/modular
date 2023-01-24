<?php

use Illuminate\Filesystem\Filesystem;

beforeEach(function () {
    $this->artisan('modular:make-module ModuleName');
});

afterEach(function () {
    (new Filesystem)->deleteDirectory(base_path('modules'));
});

it('can run modular:make-service command', function () {
    $this->artisan('modular:make-service moduleName serviceName')->assertSuccessful();
});

it('can generate a service', function () {
    $this->artisan('modular:make-service moduleName serviceName');

    $service = base_path('modules/ModuleName/Services/ServiceName.php');
    $this->assertTrue(file_exists($service));

    $serviceContent = file_get_contents($service);

    expect($serviceContent)->toContain('namespace Modules\ModuleName\Services;');
    expect($serviceContent)->toContain('class ServiceName');
});

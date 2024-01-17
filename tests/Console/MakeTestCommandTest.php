<?php

use Illuminate\Filesystem\Filesystem;

beforeEach(function () {
    $this->artisan('modular:make-module ModuleName');
});

afterEach(function () {
    (new Filesystem)->deleteDirectory(base_path('modules'));
});

it('can run modular:make-test command', function () {
    $this->artisan('modular:make-test moduleName moduleName')->assertSuccessful();
});

it('can generate a test', function () {
    $this->artisan('modular:make-test moduleName testFileName');

    $test = base_path('modules/ModuleName/Tests/testFileNameTest.php');
    $this->assertTrue(file_exists($test));

    $testContent = file_get_contents($test);

    expect($testContent)->toContain('uses(TestCase::class, RefreshDatabase::class);');
    expect($testContent)->toContain('$this->assertTrue(true);');
});

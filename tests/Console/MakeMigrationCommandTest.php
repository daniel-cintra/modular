<?php

use Illuminate\Filesystem\Filesystem;

beforeEach(function () {
    $this->artisan('modular:make-module ModuleName');
});

afterEach(function () {
    (new Filesystem)->deleteDirectory(base_path('modules'));
});

it('can run modular:make-migration command', function () {
    $this->artisan('modular:make-migration moduleName create_products_table')->assertSuccessful();
});

it('can generate a migration', function () {
    $this->artisan('modular:make-migration moduleName create_products_table');

    $migrationDirectory = base_path('modules/ModuleName/Database/Migrations');
    $migrationFiles = glob($migrationDirectory.'/*_create_products_table.php');

    $this->assertCount(1, $migrationFiles);
    $this->assertTrue(file_exists($migrationFiles[0]));

    $migrationContent = file_get_contents($migrationFiles[0]);
    expect($migrationContent)->toContain('return new class extends Migration');
});

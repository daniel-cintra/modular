<?php

use Illuminate\Filesystem\Filesystem;

beforeEach(function () {
    $this->configViewFilePath = config_path('view.php');
    $this->viewConfig = file_get_contents($this->configViewFilePath);

    $this->artisan('modular:make-module Support');
});

afterEach(function () {
    (new Filesystem)->deleteDirectory(base_path('modules'));

    file_put_contents($this->configViewFilePath, $this->viewConfig);
});

it('can run modular:publish-site-files command', function () {
    $this->artisan('modular:publish-site-files')->assertSuccessful();
});

it('can publish the modular config file', function () {
    $this->artisan('modular:publish-site-files');

    $this->assertFileExists(config_path('modular.php'));
});

it('can copy Support Module files', function () {
    $this->artisan('modular:publish-site-files');

    $this->assertFileExists(base_path('modules/Support/Http/Controllers/SiteController.php'));
    $this->assertFileExists(base_path('modules/Support/Models/SiteModel.php'));
});

it('can copy resources-site directory', function () {
    $this->artisan('modular:publish-site-files');

    $this->assertDirectoryExists(base_path('resources-site'));
    $this->assertFileExists(base_path('resources-site/js/index-app.js'));
    $this->assertFileExists(base_path('resources-site/views/site-layout.blade.php'));
});

it('can copy Index Module directory', function () {
    $this->artisan('modular:publish-site-files');

    $this->assertDirectoryExists(base_path('modules/Index'));
    $this->assertFileExists(base_path('modules/Index/IndexServiceProvider.php'));
    $this->assertFileExists(base_path('modules/Index/routes/site.php'));
    $this->assertFileExists(base_path('modules/Index/Http/Controllers/IndexController.php'));
    $this->assertFileExists(base_path('modules/Index/Models/Index.php'));
});

it('can configure views', function () {
    $this->artisan('modular:publish-site-files');

    $this->assertStringContainsString(
        "base_path('resources-site/views'),".PHP_EOL,
        file_get_contents(config_path('view.php'))
    );
});

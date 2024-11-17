<?php

use Illuminate\Filesystem\Filesystem;
use Modular\Modular\Console\RegisterServiceProviderCommand;
use Modular\Modular\ModularServiceProvider;

// Store initial content as a variable in the closure scope
$initialProvidersContent = <<<'PHP'
<?php

return [
    App\Providers\AppServiceProvider::class,
];
PHP;

beforeEach(function () use ($initialProvidersContent) {
    // Create a temporary providers.php file for testing
    $filesystem = new Filesystem;
    $bootstrapPath = $this->app->bootstrapPath();
    
    // Ensure bootstrap directory exists
    if (!$filesystem->exists($bootstrapPath)) {
        $filesystem->makeDirectory($bootstrapPath, 0755, true);
    }

    // Create providers.php with initial content
    $filesystem->put($bootstrapPath . '/providers.php', $initialProvidersContent);
});

afterEach(function () use ($initialProvidersContent) {
    // Restore the providers.php file to its initial state
    $filesystem = new Filesystem;
    $bootstrapPath = $this->app->bootstrapPath();
    $filesystem->put($bootstrapPath . '/providers.php', $initialProvidersContent);
});

/**
 * Get package providers.
 */
function getPackageProviders($app)
{
    return [
        ModularServiceProvider::class,
    ];
}

test('it runs provider registration', function () {

    $this->artisan('modular:register-provider', ['name' => 'Blog'])
        ->assertSuccessful()
        ->expectsOutput('Service provider for module Blog registered successfully.');

    $content = file_get_contents($this->app->bootstrapPath() . '/providers.php');
    
    // Check that the new provider was added
    expect($content)
        ->toContain('Modules\Blog\BlogServiceProvider::class');
});

test('it prevents duplicate service provider registration', function () {
    // First registration
    $this->artisan('modular:register-provider', ['name' => 'Blog'])
        ->assertSuccessful();

    // Try to register again
    $this->artisan('modular:register-provider', ['name' => 'Blog'])
        ->assertFailed()
        ->expectsOutput('Service provider for module Blog is already registered.');

    // Verify the provider appears only once
    $content = file_get_contents($this->app->bootstrapPath() . '/providers.php');
    expect(substr_count($content, 'Modules\Blog\BlogServiceProvider::class'))->toBe(1);
});

test('it maintains existing providers and formatting when adding new provider', function () {
    $this->artisan('modular:register-provider', ['name' => 'Blog'])
        ->assertSuccessful();

    $content = file_get_contents($this->app->bootstrapPath() . '/providers.php');
    
    // Verify the structure is maintained
    expect($content)
        ->toContain('<?php')
        ->toContain('return [')
        ->toContain('App\Providers\AppServiceProvider::class')
        ->toContain('];');

    // Check that the new provider is properly placed before the closing bracket
    expect(strpos($content, 'BlogServiceProvider::class'))->toBeLessThan(strpos($content, '];'));
});

test('it properly adds multiple new providers', function () {
    // Register multiple providers
    $this->artisan('modular:register-provider', ['name' => 'Blog'])
        ->assertSuccessful();
    $this->artisan('modular:register-provider', ['name' => 'Shop'])
        ->assertSuccessful();
    
    $content = file_get_contents($this->app->bootstrapPath() . '/providers.php');
    
    // Verify both new providers were added while maintaining existing ones
    expect($content)
        ->toContain('Modules\Blog\BlogServiceProvider::class')
        ->toContain('Modules\Shop\ShopServiceProvider::class')
        ->toContain('App\Providers\AppServiceProvider::class');

    // Verify the structure is maintained
    $lines = explode("\n", $content);
    expect($lines)->toContain('<?php');
    expect($lines)->toContain('return [');
});

test('registerServiceProvider method returns correct boolean', function () {
    $command = $this->app->make(RegisterServiceProviderCommand::class);
    
    expect($command->registerServiceProvider('NewModule'))->toBeTrue()
        ->and($command->registerServiceProvider('NewModule'))->toBeFalse();
});
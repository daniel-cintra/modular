<?php

namespace Modular\Modular\Console;

use Illuminate\Console\Command;

class RegisterServiceProviderCommand extends Command
{
    protected $signature = 'modular:register-provider {name}';

    protected $description = 'Register a module service provider';

    public function handle(): int
    {
        $moduleName = $this->argument('name');

        if ($this->registerServiceProvider($moduleName)) {
            $this->info("Service provider for module {$moduleName} registered successfully.");

            return self::SUCCESS;
        }

        $this->error("Service provider for module {$moduleName} is already registered.");

        return self::FAILURE;
    }

    public function registerServiceProvider(string $moduleName): bool
    {
        $providerPath = base_path('bootstrap/providers.php');
        $content = file_get_contents($providerPath);

        $providerClass = "Modules\\{$moduleName}\\{$moduleName}ServiceProvider::class";

        // Check if provider already exists
        if (strpos($content, $providerClass) !== false) {
            return false;
        }

        // Split content into lines
        $lines = explode("\n", $content);

        // Find the position of the closing bracket
        $returnArrayIndex = -1;
        foreach ($lines as $index => $line) {
            if (trim($line) === '];') {
                $returnArrayIndex = $index;
                break;
            }
        }

        if ($returnArrayIndex === -1) {
            return false;
        }

        // Insert the new provider before the closing bracket
        array_splice($lines, $returnArrayIndex, 0, "    {$providerClass},");

        // Join the lines back together
        $updatedContent = implode("\n", $lines);

        return (bool) file_put_contents($providerPath, $updatedContent);
    }
}

<?php

namespace Modular\Modular\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MakeModuleCommand extends Command
{
    protected $signature = 'modular:make-module {name}';

    protected $description = 'Create a new Module';

    protected string $moduleName;

    public function handle(): ?int
    {
        $this->setModuleName();

        $this->comment('Creating Module ' . $this->moduleName);

        if ($this->createModuleDirectoryStructure()) {
            $this->createServiceProvider();

            $params = [
                'moduleName' => $this->moduleName,
                'resourceName' => $this->moduleName,
            ];

            $this->call('modular:make-controller', $params);
            $this->call('modular:make-validate', $params);
            $this->call('modular:make-model', $params);
            $this->call('modular:make-route', $params);

            $this->call('modular:make-migration', ['moduleName' => $this->moduleName, 'migrationName' => "create{$this->moduleName}s_table"]);
            $this->call('modular:make-factory', $params);

            $this->call('modular:make-page', $params);
            $this->call('modular:make-test', $params);

            return self::SUCCESS;
        }

        return false;
    }

    private function setModulename(): void
    {
        $this->moduleName = Str::studly($this->argument('name'));
    }

    private function createServiceProvider(): void
    {
        $stub = file_get_contents(__DIR__ . '/../../stubs/module-stub/modules/ModuleServiceProvider.stub');

        $stub = str_replace('{{ moduleName }}', $this->moduleName, $stub);
        $stub = str_replace('{{ resourceName }}', Str::camel($this->moduleName), $stub);

        $path = base_path("modules/{$this->moduleName}/{$this->moduleName}ServiceProvider.php");

        file_put_contents($path, $stub);
    }

    private function createModuleDirectoryStructure(): bool
    {
        $modulePath = base_path("modules/{$this->moduleName}");

        // Check if the module directory already exists
        if (File::exists($modulePath)) {
            // Output an error message to the console
            $this->info("Module {$this->moduleName} already exists. SKIPPING");

            return false;
        }

        // Create the necessary directories
        (new Filesystem)->makeDirectory($modulePath);
        (new Filesystem)->makeDirectory("{$modulePath}/Http/Controllers", 0755, true);
        (new Filesystem)->makeDirectory("{$modulePath}/Http/Requests");
        (new Filesystem)->makeDirectory("{$modulePath}/Models");
        (new Filesystem)->makeDirectory("{$modulePath}/routes");
        (new Filesystem)->makeDirectory("{$modulePath}/Tests");
        (new Filesystem)->makeDirectory("{$modulePath}/Database/Migrations", 0755, true);
        (new Filesystem)->makeDirectory("{$modulePath}/Database/Factories", 0755, true);
        (new Filesystem)->makeDirectory("{$modulePath}/Database/Seeders", 0755, true);

        return true;
    }
}

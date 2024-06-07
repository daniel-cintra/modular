<?php

namespace Modular\Modular\Console;

use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Modular\Modular\Console\InstallerTraits\ModuleExists;

class MakeFactoryCommand extends Command
{
    use ModuleExists;

    protected $signature = 'modular:make-factory {moduleName} {resourceName}';

    protected $description = 'Create a new factory class for a Module';

    protected string $moduleName;

    protected string $resourceName;

    public function handle(): ?int
    {
        $this->moduleName = Str::studly($this->argument('moduleName'));
        $this->resourceName = Str::studly($this->argument('resourceName'));

        if (!$this->moduleExists()) {
            return self::FAILURE;
        }

        $this->comment('Module ' . $this->moduleName . ' found, creating Factory...');
        $this->createModuleFactory();

        return self::SUCCESS;
    }

    private function createModuleFactory(): void
    {
        (new Filesystem)->ensureDirectoryExists(base_path("modules/{$this->moduleName}/Database/Factories"));

        $stub = file_get_contents(__DIR__ . '/../../stubs/module-stub/modules/Database/Factories/ModelFactory.stub');

        $stub = str_replace('{{ ModuleName }}', $this->moduleName, $stub);
        $stub = str_replace('{{ ResourceName }}', $this->resourceName, $stub);
        $stub = str_replace('{{ resourceName }}', Str::camel($this->resourceName), $stub);

        $path = base_path("modules/{$this->moduleName}/Database/Factories/{$this->resourceName}Factory.php");

        file_put_contents($path, $stub);
    }
}

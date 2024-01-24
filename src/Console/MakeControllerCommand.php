<?php

namespace Modular\Modular\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Modular\Modular\Console\InstallerTraits\ModuleExists;

class MakeControllerCommand extends Command
{
    use ModuleExists;

    protected $signature = 'modular:make-controller {moduleName} {resourceName}';

    protected $description = 'Create a new controller class for a Module';

    protected string $moduleName;

    protected string $resourceName;

    public function handle(): ?int
    {
        $this->moduleName = Str::studly($this->argument('moduleName'));
        $this->resourceName = Str::studly($this->argument('resourceName'));

        if (! $this->moduleExists()) {
            return self::FAILURE;
        }

        $this->comment('Module '.$this->moduleName.' found, creating Controller...');
        $this->createModuleController();

        return self::SUCCESS;
    }

    private function createModuleController(): void
    {
        $stub = file_get_contents(__DIR__.'/../../stubs/module-stub/modules/Http/Controllers/ModuleController.stub');

        $stub = str_replace('{{ ModuleName }}', $this->moduleName, $stub);
        $stub = str_replace('{{ ResourceName }}', $this->resourceName, $stub);
        $stub = str_replace('{{ resourceName }}', Str::camel($this->resourceName), $stub);

        $path = base_path("modules/{$this->moduleName}/Http/Controllers/{$this->resourceName}Controller.php");

        file_put_contents($path, $stub);
    }
}

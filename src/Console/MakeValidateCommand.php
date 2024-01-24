<?php

namespace Modular\Modular\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Modular\Modular\Console\InstallerTraits\ModuleExists;

class MakeValidateCommand extends Command
{
    use ModuleExists;

    protected $signature = 'modular:make-validate {moduleName} {resourceName}';

    protected $description = 'Create a new HTTP Request Validate file for a Module';

    protected string $moduleName;

    protected string $resourceName;

    public function handle(): ?int
    {
        $this->moduleName = Str::studly($this->argument('moduleName'));
        $this->resourceName = Str::studly($this->argument('resourceName'));

        if (! $this->moduleExists()) {
            return self::FAILURE;
        }

        $this->comment('Module '.$this->moduleName.' found, creating HTTP Request Validate...');
        $this->createValidateFile();

        return self::SUCCESS;
    }

    private function createValidateFile(): void
    {
        $stub = file_get_contents(__DIR__.'/../../stubs/module-stub/modules/Http/Requests/ModuleValidate.stub');

        $stub = str_replace('{{ ModuleName }}', $this->moduleName, $stub);
        $stub = str_replace('{{ ResourceName }}', $this->resourceName, $stub);

        $path = base_path("modules/{$this->moduleName}/Http/Requests/{$this->resourceName}Validate.php");

        file_put_contents($path, $stub);
    }
}

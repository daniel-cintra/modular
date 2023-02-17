<?php

namespace Modular\Modular\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Modular\Modular\Traits\ModuleExists;

class MakeModelCommand extends Command
{
    use ModuleExists;

    protected $signature = 'modular:make-model {moduleName} {resourceName}';

    protected $description = 'Create a new model class for a Module';

    protected string $moduleName;

    protected string $resourceName;

    /**
     * Execute the console command.
     *
     * @return int|null
     */
    public function handle()
    {
        $this->moduleName = Str::studly($this->argument('moduleName'));
        $this->resourceName = Str::studly($this->argument('resourceName'));

        if (! $this->moduleExists()) {
            return self::FAILURE;
        }

        $this->comment('Module '.$this->moduleName.' found, creating model...');
        $this->createModuleModel();

        return self::SUCCESS;
    }

    private function createModuleModel(): void
    {
        $stub = file_get_contents(__DIR__.'/../../stubs/module-stub/modules/Models/Model.stub');

        $stub = str_replace('{{ ModuleName }}', $this->moduleName, $stub);
        $stub = str_replace('{{ ResourceName }}', $this->resourceName, $stub);
        $stub = str_replace('{{ resourceName }}', Str::camel($this->resourceName), $stub);

        $path = base_path("modules/{$this->moduleName}/Models/{$this->resourceName}.php");

        file_put_contents($path, $stub);
    }
}

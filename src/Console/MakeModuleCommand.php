<?php

namespace Modular\Modular\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

class MakeModuleCommand extends Command
{
    protected $signature = 'modular:make-module {name}';

    protected $description = 'Create a new module.';

    protected string $moduleName;

    /**
     * Execute the console command.
     *
     * @return int|null
     */
    public function handle()
    {
        $this->setModuleName();

        $this->comment('Creating Module '.$this->moduleName);

        $this->createModuleDirectory();
        $this->createServiceProvider();

        $this->createModuleHttpStructure();

        $params = [
            'moduleName' => $this->moduleName,
            'resourceName' => $this->moduleName,
        ];

        $this->call('modular:make-controller', $params);
        $this->call('modular:make-validate', $params);

        return self::SUCCESS;
    }

    private function setModulename()
    {
        $this->moduleName = Str::studly($this->argument('name'));
    }

    private function createModuleDirectory(): void
    {
        (new Filesystem)->makeDirectory(base_path("modules/{$this->moduleName}"));
    }

    private function createServiceProvider(): void
    {
        $stub = file_get_contents(__DIR__.'/../../stubs/module-stub/modules/ModuleServiceProvider.stub');

        $stub = str_replace('{{ moduleName }}', $this->moduleName, $stub);

        $path = base_path("modules/{$this->moduleName}/{$this->moduleName}ServiceProvider.php");

        file_put_contents($path, $stub);
    }

    private function createModuleHttpStructure(): void
    {
        (new Filesystem)->makeDirectory(base_path("modules/{$this->moduleName}/Http/Controllers"), 0755, true);
        (new Filesystem)->makeDirectory(base_path("modules/{$this->moduleName}/Http/Requests"));
    }
}

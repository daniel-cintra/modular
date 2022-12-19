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

        // $this->createModuleDirectory();
        $this->createModuleDirectoryStructure();
        $this->createServiceProvider();

        $params = [
            'moduleName' => $this->moduleName,
            'resourceName' => $this->moduleName,
        ];

        $this->call('modular:make-controller', $params);
        $this->call('modular:make-validate', $params);
        $this->call('modular:make-model', $params);
        $this->call('modular:make-route', $params);

        $this->call('make:migration', ['name' => "create{$this->moduleName}s_table"]);

        return self::SUCCESS;
    }

    private function setModulename()
    {
        $this->moduleName = Str::studly($this->argument('name'));
    }

    private function createServiceProvider(): void
    {
        $stub = file_get_contents(__DIR__.'/../../stubs/module-stub/modules/ModuleServiceProvider.stub');

        $stub = str_replace('{{ moduleName }}', $this->moduleName, $stub);

        $path = base_path("modules/{$this->moduleName}/{$this->moduleName}ServiceProvider.php");

        file_put_contents($path, $stub);
    }

    private function createModuleDirectoryStructure(): void
    {
        (new Filesystem)->makeDirectory(base_path("modules/{$this->moduleName}"));
        (new Filesystem)->makeDirectory(base_path("modules/{$this->moduleName}/Http/Controllers"), 0755, true);
        (new Filesystem)->makeDirectory(base_path("modules/{$this->moduleName}/Http/Requests"));
        (new Filesystem)->makeDirectory(base_path("modules/{$this->moduleName}/Models"));
        (new Filesystem)->makeDirectory(base_path("modules/{$this->moduleName}/routes"));
    }
}

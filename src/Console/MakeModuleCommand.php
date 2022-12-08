<?php

namespace Modular\Modular\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Illuminate\Filesystem\Filesystem;

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

        $this->comment('Creating Module ' . $this->moduleName);

        $this->createModuleDirectory();
        $this->createServiceProvider();

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
        $stub = file_get_contents(__DIR__ . '/../../stubs/module-stub/modules/ModuleServiceProvider.stub');

        $stub = str_replace('{{ moduleName }}', $this->moduleName, $stub);

        $path = base_path("modules/{$this->moduleName}/{$this->moduleName}ServiceProvider.php");

        file_put_contents($path, $stub);
    }
}

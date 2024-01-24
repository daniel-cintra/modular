<?php

namespace Modular\Modular\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use Modular\Modular\Console\InstallerTraits\ModuleExists;

class MakeComponentCommand extends Command
{
    use ModuleExists;

    protected $signature = 'modular:make-component {moduleName} {componentName}';

    protected $description = 'Create a Vue Component for the Module';

    protected string $moduleName;

    protected string $componentName;

    public function handle(): ?int
    {
        $this->moduleName = Str::studly($this->argument('moduleName'));
        $this->componentName = Str::studly($this->argument('componentName'));

        if (! $this->moduleExists()) {
            return self::FAILURE;
        }

        $this->comment('Module '.$this->moduleName.' found, creating Component...');
        $this->createComponent();

        $this->generateComments();

        return self::SUCCESS;
    }

    private function createComponent(): void
    {
        $stub = file_get_contents(__DIR__.'/../../stubs/page-stub/Components/Component.stub');

        $stub = str_replace('{{ componentName }}', Str::camel($this->componentName), $stub);

        (new Filesystem)->ensureDirectoryExists(resource_path("js/Pages/{$this->moduleName}/Components/"));

        $path = resource_path("js/Pages/{$this->moduleName}/Components/{$this->componentName}.vue");

        file_put_contents($path, $stub);
    }

    private function generateComments(): void
    {
        $this->comment('In your Vue Component, import the new created Component as:');
        $this->info("import {$this->componentName} from './Components/{$this->componentName}.vue'");
    }
}

<?php

namespace Modular\Modular\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use Modular\Modular\Console\InstallerTraits\ModuleExists;

class MakeComposableCommand extends Command
{
    use ModuleExists;

    protected $signature = 'modular:make-composable {moduleName} {composableName}';

    protected $description = 'Create a Vue Composable for the Module';

    protected string $moduleName;

    protected string $composableName;

    public function handle(): int
    {
        $this->moduleName = Str::studly($this->argument('moduleName'));
        $this->composableName = Str::studly($this->argument('composableName'));

        if (! $this->moduleExists()) {
            return self::FAILURE;
        }

        $this->comment('Module '.$this->moduleName.' found, creating Composable...');
        $this->createComposable();

        $this->generateComments();

        return self::SUCCESS;
    }

    private function createComposable(): void
    {
        $stub = file_get_contents(__DIR__.'/../../stubs/page-stub/Composables/Composable.stub');

        $stub = str_replace('{{ ComposableName }}', $this->composableName, $stub);
        $stub = str_replace('{{ composableName }}', Str::camel($this->composableName), $stub);

        (new Filesystem)->ensureDirectoryExists(resource_path("js/Pages/{$this->moduleName}/Composables/"));

        $path = resource_path("js/Pages/{$this->moduleName}/Composables/use{$this->composableName}.js");

        file_put_contents($path, $stub);
    }

    private function generateComments(): void
    {
        $camelCaseComposableName = Str::camel($this->composableName);

        $this->comment('In your Vue Component, import the composable:');
        $this->info("import use{$this->composableName} from './Composables/use{$this->composableName}'");

        $this->comment('And use it like:');
        $this->info("const { {$camelCaseComposableName} } = use{$this->composableName}()");
    }
}

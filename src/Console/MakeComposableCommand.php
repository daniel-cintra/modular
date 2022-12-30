<?php

namespace Modular\Modular\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use Modular\Modular\Traits\ModuleTrait;

class MakeComposableCommand extends Command
{
    use ModuleTrait;

    protected $signature = 'modular:make-composable {moduleName} {composableName}';

    protected $description = 'Create a Vue Composable for the Module.';

    protected string $moduleName;

    protected string $composableName;

    /**
     * Execute the console command.
     *
     * @return int|null
     */
    public function handle()
    {
        $this->moduleName = Str::studly($this->argument('moduleName'));
        $this->composableName = Str::studly($this->argument('composableName'));

        if (!$this->moduleExists()) {
            return self::FAILURE;
        }

        $this->comment('Module ' . $this->moduleName . ' found, creating composable...');
        $this->createComposable();

        $this->comment('In your Vue Component, import the composable:');
        $this->comment("import use{$this->composableName} from './Composables/use{$this->composableName}';");

        return self::SUCCESS;
    }

    private function createComposable(): void
    {
        $stub = file_get_contents(__DIR__ . '/../../stubs/page-stub/Composables/Composable.stub');

        $stub = str_replace('{{ ComposableName }}', $this->composableName, $stub);

        (new Filesystem)->ensureDirectoryExists(resource_path("js/Pages/{$this->moduleName}/Composables/"));

        $path = resource_path("js/Pages/{$this->moduleName}/Composables/use{$this->composableName}.js");

        file_put_contents($path, $stub);
    }
}

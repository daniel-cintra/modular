<?php

namespace Modular\Modular\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use Modular\Modular\Traits\ModuleExists;

class MakePageCommand extends Command
{
    use ModuleExists;

    protected $signature = 'modular:make-page {moduleName} {resourceName}';

    protected $description = 'Create the fronted page structure for CRUD operations of a Module';

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

        $this->comment('Creating Pages...');
        $this->createIndexPage();
        $this->createFormPage();

        return self::SUCCESS;
    }

    private function createIndexPage(): void
    {
        $stub = file_get_contents(__DIR__.'/../../stubs/page-stub/Index.stub');

        $stub = str_replace('{{ ResourceName }}', $this->resourceName, $stub);
        $stub = str_replace('{{ resourceName }}', Str::camel($this->resourceName), $stub);

        (new Filesystem)->ensureDirectoryExists(resource_path("js/Pages/{$this->moduleName}/"));

        $path = resource_path("js/Pages/{$this->moduleName}/{$this->resourceName}Index.vue");

        file_put_contents($path, $stub);
    }

    private function createFormPage(): void
    {
        $stub = file_get_contents(__DIR__.'/../../stubs/page-stub/Form.stub');

        $stub = str_replace('{{ ResourceName }}', $this->resourceName, $stub);
        $stub = str_replace('{{ resourceName }}', Str::camel($this->resourceName), $stub);

        (new Filesystem)->ensureDirectoryExists(resource_path("js/Pages/{$this->moduleName}/"));

        $path = resource_path("js/Pages/{$this->moduleName}/{$this->resourceName}Form.vue");

        file_put_contents($path, $stub);
    }
}

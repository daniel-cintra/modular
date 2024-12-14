<?php

namespace Modular\Modular\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use Modular\Modular\Console\InstallerTraits\ModuleExists;

class MakePageCommand extends Command
{
    use ModuleExists;

    protected $signature = 'modular:make-page {moduleName} {resourceName}';

    protected $description = 'Create the fronted page structure for CRUD operations of a Module';

    protected string $moduleName;

    protected string $resourceName;

    public function handle(): int
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

        $resourceNamePascalCase = $this->resourceName;
        $resourceNameCamelCase = Str::camel($this->resourceName);

        $stub = str_replace('{{ ResourceName }}', $resourceNamePascalCase, $stub);
        $stub = str_replace('{{ ResourceNamePascalPlural }}', Str::plural($resourceNamePascalCase), $stub);
        $stub = str_replace('{{ resourceName }}', $resourceNameCamelCase, $stub);
        $stub = str_replace('{{ resourceNameCamelPlural }}', Str::plural($resourceNameCamelCase), $stub);

        (new Filesystem)->ensureDirectoryExists(resource_path("js/Pages/{$this->moduleName}/"));

        $path = resource_path("js/Pages/{$this->moduleName}/{$this->resourceName}Index.vue");

        file_put_contents($path, $stub);
    }

    private function createFormPage(): void
    {
        $stub = file_get_contents(__DIR__.'/../../stubs/page-stub/Form.stub');

        $resourceNamePascalCase = $this->resourceName;

        $stub = str_replace('{{ ResourceName }}', $resourceNamePascalCase, $stub);
        $stub = str_replace('{{ ResourceNamePascalPlural }}', Str::plural($resourceNamePascalCase), $stub);
        $stub = str_replace('{{ resourceName }}', Str::camel($this->resourceName), $stub);

        (new Filesystem)->ensureDirectoryExists(resource_path("js/Pages/{$this->moduleName}/"));

        $path = resource_path("js/Pages/{$this->moduleName}/{$this->resourceName}Form.vue");

        file_put_contents($path, $stub);
    }
}

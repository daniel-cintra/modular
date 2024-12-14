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

    protected Filesystem $filesystem;

    public function __construct(Filesystem $filesystem)
    {
        parent::__construct();
        $this->filesystem = $filesystem;
    }

    public function handle(): int
    {
        $this->initializeNames();
        $this->comment('Creating Pages...');

        $this->createPage('Index');
        $this->createPage('Form');

        return self::SUCCESS;
    }

    private function initializeNames(): void
    {
        $this->moduleName = Str::studly($this->argument('moduleName'));
        $this->resourceName = Str::studly($this->argument('resourceName'));
    }

    private function createPage(string $type): void
    {
        $stub = $this->getStubContent($type);
        $replacements = $this->getReplacements($type);

        $processedStub = $this->processStub($stub, $replacements);
        $this->saveStub($processedStub, $type);
    }

    private function getStubContent(string $type): string
    {
        return file_get_contents(__DIR__."/../../stubs/page-stub/{$type}.stub");
    }

    private function getReplacements(string $type): array
    {
        $resourceNamePascalCase = $this->resourceName;
        $resourceNameCamelCase = Str::camel($this->resourceName);

        $replacements = [
            '{{ ResourceName }}' => $resourceNamePascalCase,
            '{{ ResourceNamePascalPlural }}' => Str::plural($resourceNamePascalCase),
            '{{ resourceName }}' => $resourceNameCamelCase,
        ];

        if ($type === 'Index') {
            $replacements['{{ resourceNameCamelPlural }}'] = Str::plural($resourceNameCamelCase);
        }

        return $replacements;
    }

    private function processStub(string $stub, array $replacements): string
    {
        return str_replace(
            array_keys($replacements),
            array_values($replacements),
            $stub
        );
    }

    private function saveStub(string $processedStub, string $type): void
    {
        $directory = resource_path("js/Pages/{$this->moduleName}/");
        $this->filesystem->ensureDirectoryExists($directory);

        $path = $directory."{$this->resourceName}{$type}.vue";
        file_put_contents($path, $processedStub);
    }
}

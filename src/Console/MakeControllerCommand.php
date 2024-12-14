<?php

namespace Modular\Modular\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use Modular\Modular\Console\InstallerTraits\ModuleExists;

class MakeControllerCommand extends Command
{
    use ModuleExists;

    protected $signature = 'modular:make-controller {moduleName} {resourceName}';

    protected $description = 'Create a new controller class for a Module';

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

        if (! $this->moduleExists()) {
            return self::FAILURE;
        }

        $this->comment('Module '.$this->moduleName.' found, creating Controller...');
        $this->createModuleController();

        return self::SUCCESS;
    }

    private function initializeNames(): void
    {
        $this->moduleName = Str::studly($this->argument('moduleName'));
        $this->resourceName = Str::studly($this->argument('resourceName'));
    }

    private function createModuleController(): void
    {
        $stub = $this->getStubContent();
        $replacements = $this->getReplacements();

        $processedStub = $this->processStub($stub, $replacements);
        $this->saveStub($processedStub);
    }

    private function getStubContent(): string
    {
        return file_get_contents(__DIR__.'/../../stubs/module-stub/modules/Http/Controllers/ModuleController.stub');
    }

    private function getReplacements(): array
    {
        $resourceNameCamelCase = Str::camel($this->resourceName);

        return [
            '{{ ModuleName }}' => $this->moduleName,
            '{{ ResourceName }}' => $this->resourceName,
            '{{ resourceName }}' => $resourceNameCamelCase,
            '{{ resourceNameCamelPlural }}' => Str::plural($resourceNameCamelCase),
        ];
    }

    private function processStub(string $stub, array $replacements): string
    {
        return str_replace(
            array_keys($replacements),
            array_values($replacements),
            $stub
        );
    }

    private function saveStub(string $processedStub): void
    {
        $directory = base_path("modules/{$this->moduleName}/Http/Controllers/");
        $this->filesystem->ensureDirectoryExists($directory);

        $path = $directory."{$this->resourceName}Controller.php";
        file_put_contents($path, $processedStub);
    }
}

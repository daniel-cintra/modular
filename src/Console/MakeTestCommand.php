<?php

namespace Modular\Modular\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use Modular\Modular\Console\InstallerTraits\ModuleExists;

class MakeTestCommand extends Command
{
    use ModuleExists;

    protected $signature = 'modular:make-test {moduleName} {resourceName}';

    protected $description = 'Create a new test file for a Module';

    protected string $moduleName;

    protected string $testFileName;

    public function handle(): int
    {
        $this->moduleName = Str::studly($this->argument('moduleName'));
        $this->testFileName = $this->argument('resourceName');

        if (! $this->moduleExists()) {
            return self::FAILURE;
        }

        $this->comment('Module '.$this->moduleName.' found, creating test file...');
        $this->createTestFile();

        return self::SUCCESS;
    }

    private function createTestFile(): void
    {
        (new Filesystem)->ensureDirectoryExists(base_path("modules/{$this->moduleName}/Tests/"));

        $stub = file_get_contents(__DIR__.'/../../stubs/module-stub/modules/Tests/ModuleTest.stub');

        $path = base_path("modules/{$this->moduleName}/Tests/{$this->testFileName}Test.php");

        file_put_contents($path, $stub);
    }
}

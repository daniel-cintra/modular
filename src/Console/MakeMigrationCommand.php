<?php

namespace Modular\Modular\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use Modular\Modular\Traits\ModuleExists;

class MakeMigrationCommand extends Command
{
    use ModuleExists;

    protected $signature = 'modular:make-migration {moduleName} {migrationName}';

    protected $description = 'Create a new migration file for a Module';

    protected string $moduleName;

    protected string $migrationName;

    public function handle(): ?int
    {
        $this->moduleName = Str::studly($this->argument('moduleName'));
        $this->migrationName = $this->argument('migrationName');

        if (! $this->moduleExists()) {
            return self::FAILURE;
        }

        $this->comment('Module '.$this->moduleName.' found, creating migration file...');
        $this->createMigrationFile();

        return self::SUCCESS;
    }

    private function createMigrationFile(): void
    {
        (new Filesystem)->ensureDirectoryExists(base_path("modules/{$this->moduleName}/Database/Migrations"));

        $this->call('make:migration', [
            'name' => $this->migrationName,
            '--path' => "modules/{$this->moduleName}/Database/Migrations",
        ]);
    }
}

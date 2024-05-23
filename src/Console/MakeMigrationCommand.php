<?php

namespace Modular\Modular\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use Modular\Modular\Console\InstallerTraits\ModuleExists;

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

        if (!$this->moduleExists()) {
            return self::FAILURE;
        }

        $this->comment('Module ' . $this->moduleName . ' found, creating migration file...');
        $this->createMigrationFile();

        return self::SUCCESS;
    }

    private function createMigrationFile(): void
    {
        (new Filesystem)->ensureDirectoryExists(base_path("modules/{$this->moduleName}/Database/Migrations"));

        /** Run Laravels default migration command */
        // $this->call('make:migration', [
        //     'name' => $this->migrationName,
        //     '--path' => "modules/{$this->moduleName}/Database/Migrations",
        // ]);

        /** Create migration according to stub */
        $stub = file_get_contents(__DIR__ . '/../../stubs/module-stub/modules/Database/Migrations/create_table.stub');

        $tableName = strtolower(Str::plural($this->moduleName));

        $stub = str_replace('{{ tableName }}', $tableName, $stub);

        $path = base_path("modules/{$this->moduleName}/Database/Migrations/" . date('Y_m_d_His_') . "create_{$tableName}_table.php");

        file_put_contents($path, $stub);
    }
}

<?php

namespace Modular\Modular\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use Modular\Modular\Traits\ModuleExists;

class MakeServiceCommand extends Command
{
    use ModuleExists;

    protected $signature = 'modular:make-service {moduleName} {serviceName}';

    protected $description = 'Create a new service class for a Module';

    protected string $moduleName;

    protected string $serviceName;

    /**
     * Execute the console command.
     *
     * @return int|null
     */
    public function handle()
    {
        $this->moduleName = Str::studly($this->argument('moduleName'));
        $this->serviceName = Str::studly($this->argument('serviceName'));

        if (! $this->moduleExists()) {
            return self::FAILURE;
        }

        $this->comment('Module '.$this->moduleName.' found, creating service...');
        $this->createModuleService();

        return self::SUCCESS;
    }

    private function createModuleService(): void
    {
        (new Filesystem)->ensureDirectoryExists(base_path("modules/{$this->moduleName}/Services/"));

        $stub = file_get_contents(__DIR__.'/../../stubs/module-stub/modules/Services/Service.stub');

        $stub = str_replace('{{ ModuleName }}', $this->moduleName, $stub);
        $stub = str_replace('{{ ServiceName }}', $this->serviceName, $stub);

        $path = base_path("modules/{$this->moduleName}/Services/{$this->serviceName}.php");

        file_put_contents($path, $stub);
    }
}

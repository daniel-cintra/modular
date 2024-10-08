<?php

namespace Modular\Modular\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Modular\Modular\Console\InstallerTraits\ModuleExists;

class MakeRouteCommand extends Command
{
    use ModuleExists;

    protected $signature = 'modular:make-route {moduleName} {resourceName}';

    protected $description = 'Create a new route file for a Module';

    protected string $moduleName;

    protected string $resourceName;

    public function handle(): int
    {
        $this->moduleName = Str::studly($this->argument('moduleName'));
        $this->resourceName = Str::studly($this->argument('resourceName'));

        if (! $this->moduleExists()) {
            return self::FAILURE;
        }

        $this->comment('Module '.$this->moduleName.' found, creating Route...');
        $this->createModuleRoute();

        return self::SUCCESS;
    }

    private function createModuleRoute(): void
    {
        $stub = file_get_contents(__DIR__.'/../../stubs/module-stub/modules/routes/app.stub');

        $stub = str_replace('{{ resource-name }}', Str::snake($this->resourceName, '-'), $stub);
        $stub = str_replace('{{ ResourceName }}', $this->resourceName, $stub);
        $stub = str_replace('{{ resourceName }}', Str::camel($this->resourceName), $stub);

        $path = base_path("modules/{$this->moduleName}/routes/app.php");

        if (! file_exists($path)) {
            file_put_contents($path, $stub);
        } else {
            $stub = str_replace('<?php', '', $stub);
            $stub = str_replace('use Illuminate\Support\Facades\Route;', '// '.Str::camel($this->resourceName).' routes', $stub);

            file_put_contents($path, $stub, FILE_APPEND);
        }
    }
}

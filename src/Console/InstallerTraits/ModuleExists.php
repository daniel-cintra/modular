<?php

namespace Modular\Modular\Console\InstallerTraits;

trait ModuleExists
{
    private function moduleExists(): bool
    {
        if (! is_dir(base_path("modules/{$this->moduleName}"))) {
            $this->components->error("Module {$this->moduleName} does not exist.");

            return false;
        }

        return true;
    }
}

<?php

namespace Modular\Modular\Traits;

trait ModuleTrait
{
    private function moduleExists(): bool
    {
        if (! is_dir(base_path("modules/{$this->moduleName}"))) {
            $this->error("Module {$this->moduleName} does not exist.");

            return false;
        }

        return true;
    }
}

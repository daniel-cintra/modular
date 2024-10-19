<?php

namespace Modular\Modular\Console\InstallerTraits;

use Illuminate\Filesystem\Filesystem;
use RuntimeException;
use Symfony\Component\Process\Process;

trait FrontendPackages
{
    /**
     * Install the Inertia Vue Breeze stack.
     */
    protected function installFrontendPackages(): void
    {
        $this->components->info('Installing npm packages...');

        static::updateNodePackages(fn ($packages) => [

            '@inertiajs/vue3' => '^1.0.15',

            '@tailwindcss/forms' => '^0.5.6',
            '@vitejs/plugin-vue' => '^5.0.4',

            'autoprefixer' => '^10.4.18',
            'eslint' => '^v9.5.0',
            'eslint-config-prettier' => '^9.1.0',
            'eslint-plugin-vue' => '^v9.23.0',

            'postcss' => '^8.4.35',
            'postcss-import' => '^16.0.1',
            'prettier' => '^3.2.5',
            'prettier-plugin-blade' => '^2.1.18',
            'prettier-plugin-tailwindcss' => '^v0.6.5',

            '@tiptap/vue-3' => '^2.2.4',
            '@tiptap/starter-kit' => '^2.2.4',
            '@tiptap/extension-link' => '^2.2.4',
            '@tiptap/extension-underline' => '^2.2.4',
            '@tiptap/extension-image' => '^2.2.4',
            '@tiptap/extension-youtube' => '^2.2.4',
            '@tiptap/extension-table' => '^2.2.4',
            '@tiptap/extension-table-header' => '^2.2.4',
            '@tiptap/extension-table-row' => '^2.2.4',
            '@tiptap/extension-table-cell' => '^2.2.4',

            'remixicon' => '^4.2.0',
            'tailwindcss' => '^3.3.7',
            'unplugin-vue-components' => '^0.27.1',
            'vue' => '^3.4.21',

        ] + $packages);

        $this->removeDefaultTailwindConfig();

        // Config files...
        copy(__DIR__.'/../../../stubs/stack-configs/postcss.config.cjs', base_path('postcss.config.cjs'));
        copy(__DIR__.'/../../../stubs/stack-configs/tailwind.config.cjs', base_path('tailwind.config.cjs'));
        copy(__DIR__.'/../../../stubs/stack-configs/jsconfig.json', base_path('jsconfig.json'));
        copy(__DIR__.'/../../../stubs/stack-configs/vite.config.js', base_path('vite.config.js'));
        copy(__DIR__.'/../../../stubs/stack-configs/.eslintrc.cjs', base_path('.eslintrc.cjs'));
        copy(__DIR__.'/../../../stubs/stack-configs/.prettierrc.json', base_path('.prettierrc.json'));

        (new Filesystem)->copyDirectory(__DIR__.'/../../../stubs/stack-configs/.vscode', base_path('.vscode'));

        $this->runCommands(['npm install']);

        $this->line('');
        $this->components->info('npm packages installed successfully!');
    }

    protected static function updateNodePackages(callable $callback, bool $dev = true): void
    {
        if (! file_exists(base_path('package.json'))) {
            return;
        }

        $configurationKey = $dev ? 'devDependencies' : 'dependencies';

        $packages = json_decode(file_get_contents(base_path('package.json')), true, 512, JSON_THROW_ON_ERROR);

        $packages[$configurationKey] = $callback(
            array_key_exists($configurationKey, $packages) ? $packages[$configurationKey] : [],
            $configurationKey
        );

        ksort($packages[$configurationKey]);

        file_put_contents(
            base_path('package.json'),
            json_encode($packages, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT).PHP_EOL
        );
    }

    protected function runCommands(array $commands): void
    {
        $process = Process::fromShellCommandline(implode(' && ', $commands), null, null, null, null);

        if ('\\' !== DIRECTORY_SEPARATOR && file_exists('/dev/tty') && is_readable('/dev/tty')) {
            try {
                $process->setTty(true);
            } catch (RuntimeException $e) {
                $this->output->writeln('  <bg=yellow;fg=black> WARN </> '.$e->getMessage().PHP_EOL);
            }
        }

        $process->run(function ($type, $line) {
            $this->output->write('    '.$line);
        });
    }

    protected function removeDefaultTailwindConfig(): void
    {
        $tailwindConfigPath = base_path('tailwind.config.js');

        if (! file_exists($tailwindConfigPath)) {
            return;
        }

        try {
            unlink($tailwindConfigPath);
            $this->info('Default tailwind.config.js removed.');
        } catch (\Exception $e) {
            $this->error('Unable to remove default tailwind.config.js. Please check file permissions.');
        }
    }
}

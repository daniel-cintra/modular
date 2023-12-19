<?php

namespace Modular\Modular\Console;

use Illuminate\Filesystem\Filesystem;
use RuntimeException;
use Symfony\Component\Process\Process;

trait FrontendPackages
{
    /**
     * Install the Inertia Vue Breeze stack.
     *
     * @return void
     */
    protected function installFrontendPackages()
    {
        $this->components->info('Installing npm packages...');

        static::updateNodePackages(fn ($packages) => [

            '@inertiajs/vue3' => '^1.0.13',

            '@tailwindcss/forms' => '^0.5.6',
            '@vitejs/plugin-vue' => '^4.5.2',

            'autoprefixer' => '^10.4.16',
            'eslint' => '^v8.56.0',
            'eslint-config-prettier' => '^9.1.0',
            'eslint-plugin-vue' => '^v9.19.2',
            'laravel-vite-plugin' => '^v0.8.1',

            'postcss' => '^8.4.32',
            'postcss-import' => '^15.1.0',
            'prettier' => '^3.1.1',
            'prettier-plugin-tailwindcss' => '^v0.5.9',

            '@tiptap/vue-3' => '^2.1.13',
            '@tiptap/starter-kit' => '^2.1.13',
            '@tiptap/extension-link' => '^2.1.13',
            '@tiptap/extension-underline' => '^2.1.13',
            '@tiptap/extension-image' => '^2.1.13',
            '@tiptap/extension-youtube' => '^2.1.13',
            '@tiptap/extension-table' => '^2.1.13',
            '@tiptap/extension-table-header' => '^2.1.13',
            '@tiptap/extension-table-row' => '^2.1.13',
            '@tiptap/extension-table-cell' => '^2.1.13',

            'remixicon' => '^4.0.1',
            'tailwindcss' => '^3.3.7',
            'unplugin-vue-components' => '^0.26.0',
            'vite' => '^4.5.1',
            'vue' => '^3.3.13',

        ] + $packages);

        // Config files...
        copy(__DIR__.'/../../stubs/stack-configs/postcss.config.cjs', base_path('postcss.config.cjs'));
        copy(__DIR__.'/../../stubs/stack-configs/tailwind.config.cjs', base_path('tailwind.config.cjs'));
        copy(__DIR__.'/../../stubs/stack-configs/jsconfig.json', base_path('jsconfig.json'));
        copy(__DIR__.'/../../stubs/stack-configs/vite.config.js', base_path('vite.config.js'));
        copy(__DIR__.'/../../stubs/stack-configs/.eslintrc.cjs', base_path('.eslintrc.cjs'));
        copy(__DIR__.'/../../stubs/stack-configs/.prettierrc.json', base_path('.prettierrc.json'));

        (new Filesystem)->copyDirectory(__DIR__.'/../../stubs/stack-configs/.vscode', base_path('.vscode'));

        $this->runCommands(['npm install']);

        $this->line('');
        $this->components->info('npm packages installed successfully!');
    }

    /**
     * Update the "package.json" file.
     *
     * @param  bool  $dev
     * @return void
     */
    protected static function updateNodePackages(callable $callback, $dev = true)
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

    /**
     * Run the given commands.
     *
     * @param  array  $commands
     * @return void
     */
    protected function runCommands($commands)
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
}

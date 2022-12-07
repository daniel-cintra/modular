<?php

namespace Modular\Modular\Console;

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

        $this->updateNodePackages(function ($packages) {
            return [

                '@inertiajs/inertia' => '^0.11.0',
                '@inertiajs/inertia-vue3' => '^0.6.0',
                '@inertiajs/progress' => '^0.2.7',
                '@tailwindcss/forms' => '^0.5.2',
                '@vitejs/plugin-vue' => '^3.0.0',
                '@vueuse/core' => '^9.1.1',

                'autoprefixer' => '^10.4.2',
                'axios' => '^0.27',
                'eslint' => '^8.23.0',
                'eslint-config-prettier' => '^8.5.0',
                'eslint-plugin-vue' => '^9.4.0',
                'laravel-vite-plugin' => '^0.5.0',
                'lodash' => '^4.17.19',

                'postcss' => '^8.4.6',
                'postcss-import' => '^15.0.0',
                'prettier' => '^2.7.1',
                'prettier-plugin-tailwindcss' => '^0.1.13',
                'primeicons' => '^5.0.0',
                'primevue' => '^3.16.1',

                '@tiptap/vue-3' => '^2.0.0-beta.204',
                '@tiptap/starter-kit' => '^2.0.0-beta.204',
                '@tiptap/extension-link' => '^2.0.0-beta.204',
                '@tiptap/extension-underline' => '^2.0.0-beta.204',
                '@tiptap/extension-youtube' => '^2.0.0-beta.204',
                '@tiptap/extension-table' => '^2.0.0-beta.204',
                '@tiptap/extension-table-header' => '^2.0.0-beta.204',
                '@tiptap/extension-table-row' => '^2.0.0-beta.204',
                '@tiptap/extension-table-cell' => '^2.0.0-beta.204',

                'remixicon' => '^2.5.0',
                'tailwindcss' => '^3.1.0',
                'unplugin-vue-components' => '^0.22.7',
                'vite' => '^3.0.0',
                'vue' => '^3.2.31',

            ] + $packages;
        });

        // Config files...
        copy(__DIR__.'/../../stubs/stack-configs/postcss.config.js', base_path('postcss.config.js'));
        copy(__DIR__.'/../../stubs/stack-configs/tailwind.config.js', base_path('tailwind.config.js'));
        copy(__DIR__.'/../../stubs/stack-configs/jsconfig.json', base_path('jsconfig.json'));
        copy(__DIR__.'/../../stubs/stack-configs/vite.config.js', base_path('vite.config.js'));
        copy(__DIR__.'/../../stubs/stack-configs/.eslintrc.js', base_path('.eslintrc.js'));
        copy(__DIR__.'/../../stubs/stack-configs/.prettierrc.json', base_path('.prettierrc.json'));

        $this->runCommands(['npm install']);

        $this->line('');
        $this->components->info('npm packages installed successfully!');
    }

    /**
     * Update the "package.json" file.
     *
     * @param  callable  $callback
     * @param  bool  $dev
     * @return void
     */
    protected static function updateNodePackages(callable $callback, $dev = true)
    {
        if (! file_exists(base_path('package.json'))) {
            return;
        }

        $configurationKey = $dev ? 'devDependencies' : 'dependencies';

        $packages = json_decode(file_get_contents(base_path('package.json')), true);

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

import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'
import vue from '@vitejs/plugin-vue'

import Components from 'unplugin-vue-components/vite'
import AppComponentsResolver from './resources/js/Resolvers/AppComponentsResolver.js'

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/js/app.js',
                'resources-site/js/**/*.js',
                'resources-site/js/components/**/*.vue',
                'resources-site/css/**/*.css'
            ],
            refresh: [
                'resources/**/*',
                'resources-site/**/*',
                'modules/**/views/**/*.blade.php'
            ]
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false
                }
            }
        }),
        Components({
            resolvers: [AppComponentsResolver]
        })
    ],
    resolve: {
        alias: {
            '@resources': '/resources',
            '@resourcesSite': '/resources-site'
        }
    }
})

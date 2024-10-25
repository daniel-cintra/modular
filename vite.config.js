import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'
import vue from '@vitejs/plugin-vue'

import Components from 'unplugin-vue-components/vite'
import AppComponentsResolver from './resources/js/Resolvers/AppComponentsResolver.js'

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/js/app.js'
            ],
            refresh: [
                'resources/**/*'
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
            '@resources': '/resources'
        }
    }
})

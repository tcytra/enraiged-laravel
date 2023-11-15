import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

const path = require('path');

export default defineConfig({
    resolve: {
        alias: {
            '~' : path.resolve(__dirname, './node_modules/'),
            '!' : path.resolve(__dirname, './resources/'),
        },
    },
    plugins: [
        vue({
            template: {
                base: null,
                compilerOptions: {
                    directiveTransforms: {
                        ripple: () => ({
                            props: [],
                            needRuntime: true,
                        }),
                    },
                },
                transformAssetUrls: {
                    includeAbsolute: false,
                },
            },
        }),
        laravel({
            input: 'resources/js/app.js',
            ssr: 'resources/js/ssr.js',
            refresh: true,
        }),
    ],
    build: {
        chunkSizeWarningLimit: 1024,
    },
});

import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

const path = require('path');

export default defineConfig({
    resolve: {
        alias: {
            '~' : path.resolve(__dirname, './node_modules'),
        },
    },
    plugins: [
        vue({
            template: {
                compilerOptions: {
                    directiveTransforms: {
                        ripple: () => ({
                            props: [],
                            needRuntime: true,
                        }),
                    },
                },
                base: null,
                includeAbsolute: false,
            },
        }),
        laravel({
            input: 'resources/js/app.js',
            ssr: 'resources/js/ssr.js',
            refresh: true,
        }),
    ],
    build: {
        rollupOptions: {
            output: {
                manualChunks: {},
            },
        },
    },
});

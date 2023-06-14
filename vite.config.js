import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue'
import path from 'path'
import svgLoader from 'vite-svg-loader';

export default defineConfig({
    plugins: [
        vue(),
        laravel([
            'resource/scss/app.scss',
            'resources/js/app.js',
        ]),
        svgLoader(),
    ],
    resolve: {
        alias: {
            '@': '/resources/js',
        }
    },
});
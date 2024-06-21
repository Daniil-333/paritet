import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import {esbuildCommonjs} from "@originjs/vite-plugin-commonjs";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/scss/app.scss',
                'resources/js/app.js',
            ],
        }),
    ],
    optimizeDeps: {
        esbuildOptions:{
            plugins:[
                esbuildCommonjs(['wow.js'])
            ]
        }
    }
});

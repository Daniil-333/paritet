import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            hotFile: 'public/admin.hot',
            buildDirectory: 'build/admin',
            input: ['resources/scss/admin/app.scss', 'resources/js/admin/app.js'],
            refresh: [
                'resources/routes/**',
                'routes/**',
                'resources/views/layouts/**',
                'resources/views/admin/**',
                'resources/scss/admin/**',
                'resources/js/admin/**',
            ],
        }),
    ],
});

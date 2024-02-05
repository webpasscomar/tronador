import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'public/fontawesome/css/all.css',
                'public/fontawesome/css/fontawesome.css',
                'public/fontawesome/css/brands.css',
                'public/fontawesome/css/solid.css',
                'public/css/custom.css',
                'resources/js/app.js',
                'public/js/jquery.min.js',
                'public/js/bootstrap.bundle.min.js'
            ],
            refresh: true,
        }),
    ],
});

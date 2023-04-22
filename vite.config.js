import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: [
                "resources/routes/**",
                "resources/css/**",
                "resources/js/**",
                "routes/**",
                "resources/views/**"
            ],
        }),
    ],
});

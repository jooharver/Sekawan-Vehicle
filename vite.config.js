import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js', 'resources/css/filament/admin/theme.css'],
            refresh: true,
        }),
    ],

    build: {
        rollupOptions: {
            input: [
                // Input lain jika ada...
                'resources/css/filament/admin/theme.css', // Tambahkan baris ini
            ],
        },
    },
});

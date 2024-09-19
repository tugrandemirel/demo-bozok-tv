import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import ckeditor5 from '@ckeditor/vite-plugin-ckeditor5';
import path from 'path'; // Path modülünü doğru bir şekilde import ediyoruz

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/custom.css',
                'resources/js/app.js',

                "resources/js/admin/ckeditor.js",

                // NEWSLETTER
                "resources/js/admin/newsletter/create.js",
                "resources/js/admin/newsletter/create/general-setting-tab.js",
                "resources/js/admin/newsletter/category-store.js",
                "resources/js/admin/newsletter/newsletter-source-store.js",
                "resources/js/admin/newsletter/create/store.js",

            ],

            refresh: true,
        }),
        ckeditor5({ theme: require.resolve('@ckeditor/ckeditor5-theme-lark') }),
    ],
    resolve: {
        alias: {
            '@tagify': path.resolve(__dirname, 'node_modules/@yaireo/tagify/dist/tagify.esm.js'),
        },
    },
});

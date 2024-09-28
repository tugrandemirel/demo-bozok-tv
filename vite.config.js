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
                "resources/js/select2.js",

                "resources/js/admin/ckeditor.js",

                // NEWSLETTER
                "resources/js/admin/newsletter/create.js",
                "resources/js/admin/newsletter/general-setting-tab.js",
                "resources/js/admin/newsletter/category-store.js",
                "resources/js/admin/newsletter/newsletter-source-store.js",
                "resources/js/admin/newsletter/create/store.js",
                "resources/js/admin/newsletter/fetch-newsletters-datatable.js",
                "resources/js/admin/newsletter/edit.js",
                "resources/js/admin/newsletter/update.js",

                "resources/js/admin/newsletter/show/publication-status.js",

            ],

            refresh: true,
        }),
        ckeditor5({ theme: require.resolve('@ckeditor/ckeditor5-theme-lark') }),
    ],
});

import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import ckeditor5 from '@ckeditor/vite-plugin-ckeditor5';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/custom.css',
                'resources/js/app.js',
                "resources/js/select2.js",
                "resources/js/summernote.js",
                "resources/js/admin/ckeditor.js",
                "resources/css/custom-summernote.css",

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

                // GALLERY
                "resources/js/admin/gallery/index.js",
                "resources/js/admin/gallery/store.js",
                "resources/js/admin/gallery/edit.js",
                "resources/js/admin/gallery/update.js",

                "resources/js/admin/gallery/video-gallery/video-preview.js",
                "resources/js/admin/gallery/video-gallery/store.js",
                "resources/js/admin/gallery/video-gallery/single-video-status-update-modal.js",
                "resources/js/admin/gallery/video-gallery/update.js",

                "resources/js/admin/image/store.js",
                "resources/js/admin/image/index.js",
                "resources/js/admin/image/edit.js",
                "resources/js/admin/image/update.js",



                // AUTHOR

                "resources/js/author/posts/fetch-posts-datatable.js",
            ],

            refresh: true,
        }),
        ckeditor5({ theme: require.resolve('@ckeditor/ckeditor5-theme-lark') }),
    ],
});

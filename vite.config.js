import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/custom.css',
                "resources/css/full-screen-modal.css",
                'resources/js/app.js',
                "resources/js/select2.js",
                "resources/js/summernote.js",
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

                // POST
                "resources/js/admin/posts/fetch-posts-datatable.js",
                "resources/js/admin/posts/post-status-modal.js",


                // AUTHOR

                "resources/js/author/posts/fetch-posts-datatable.js",
                "resources/js/author/posts/update.js",
                "resources/js/author/posts/store.js",
                "resources/js/author/posts/image-upload.js",
            ],

            refresh: true,
        }),
    ],
});

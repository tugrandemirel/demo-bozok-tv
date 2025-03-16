import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                "resources/css/home.css",
                "resources/css/page.css",
                "resources/css/page-detail.css",
                'resources/css/custom.css',
                "resources/css/full-screen-modal.css",
                'resources/js/app.js',
                "resources/js/select2.js",
                "resources/js/summernote.js",
                'resources/js/daterange.js',
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

                // MAIN HEADLINE
                "resources/js/admin/newsletter/main-headline/draggable.js",
                "resources/js/admin/newsletter/fetch-newsletter-outstandings-datatable.js",
                "resources/js/admin/newsletter/fetch-newsletter-five-cuffs-datatable.js",
                "resources/js/admin/newsletter/fetch-newsletter-last-minutes-datatable.js",
                "resources/js/admin/newsletter/fetch-newsletter-today-headlines-datatable.js",

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


                //SURVEY
                "resources/js/admin/surveys/store-survey-modal.php.js",
                "resources/js/admin/surveys/edit-survey-modal.js",
                "resources/js/admin/surveys/update-survey-modal.js",
                "resources/js/admin/surveys/fetch-surveys-datatable.js",
                "resources/js/admin/surveys/destroy-survey.js",

                // QUESTION
                "resources/js/admin/surveys/show/fetch-survey-question-datatable.js",
                "resources/js/admin/surveys/show/create-survey-question-modal.js",
                "resources/js/admin/surveys/show/store-survey-question-modal.js",
                "resources/js/admin/surveys/show/edit-survey-question-modal.js",
                "resources/js/admin/surveys/show/update-survey-question-modal.js",
                "resources/js/admin/surveys/show/destroy-survey-question.js",

                // PROFILE
                "resources/js/admin/profile/update-personal-information.js",
                "resources/js/admin/profile/profile-image.js",
                "resources/js/admin/profile/update-change-password.js",
                "resources/js/admin/input-mask.js",

                // site setting
                "resources/js/admin/site-setting/general-setting/image.js",
                "resources/js/admin/site-setting/general-setting/update.js",
                "resources/js/admin/site-setting/contact-setting/update.js",
                "resources/js/admin/site-setting/seo-setting/update.js",
                "resources/js/admin/site-setting/social-media-setting/repeater.js",
                "resources/js/admin/site-setting/social-media-setting/update.js",

                // ADS
                "resources/js/admin/ads/create.js",
                "resources/js/admin/ads/store.js",

                // FRONT

                "resources/js/front/swiper/five-cuff.js",
                "resources/js/front/swiper/main-headline.js",
                "resources/js/front/swiper/politic.js",
                "resources/js/front/swiper/photo-gallery.js",
                "resources/js/front/swiper/page.js",
            ],

            refresh: true,
        }),
    ],
});

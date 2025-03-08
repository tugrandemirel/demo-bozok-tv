<?php

namespace App\Repositories;

use App\Models\Newsletter;
use App\Models\NewsletterOutstanding;
use App\Models\NewsletterTodayHeadline;

class NewsletterTodayHeadlinesRepository
{
    public function getTodayHeadlinesForDatatable()
    {
        $newsletter_today_headlines = NewsletterTodayHeadline::query()
            ->select("newsletter_today_headlines.id", "newsletter_today_headlines.order")
            ->addSelect( "newsletters.title", "categories.name as category", "newsletter_sources.name as source", "newsletters.created_at", "newsletters.uuid")
            ->addSelect("newsletter_publication_statuses.name as status_name", "newsletter_publication_statuses.code as status_code")
            ->addSelect(  "morph_images.path as image")
            ->join("newsletters", function ($join) {
                $join->on("newsletters.id", "=", "newsletter_today_headlines.newsletter_id")
                    ->join("morph_images", function ($sub_join) {
                        $sub_join->on("morph_images.imageable_id", "=", "newsletters.id")
                            ->where("morph_images.imageable_type", "=", Newsletter::class)
                            ->where("morph_images.image_type", "=", "COVER");
                    })
                    ->join("newsletter_publication_statuses", function ($sub_join) {
                        $sub_join->on("newsletter_publication_statuses.id", "=", "newsletters.newsletter_publication_status_id");
                    })
                    ->join("categories", function ($sub_join) {
                        $sub_join->on("categories.id", "=", "newsletters.category_id");
                    })
                    ->join("newsletter_sources", function ($sub_join) {
                        $sub_join->on("newsletter_sources.id", "=", "newsletters.newsletter_source_id");
                    });
            })
            ->orderByDesc("newsletter_today_headlines.order");

        return $newsletter_today_headlines;

    }
}

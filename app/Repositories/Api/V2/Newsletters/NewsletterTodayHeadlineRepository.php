<?php

namespace App\Repositories\Api\V2\Newsletters;

use App\Enum\MorphImage\MorphImageImageTypeEnum;
use App\Models\Newsletter;
use App\Models\NewsletterLastMinute;
use App\Models\NewsletterPublicationStatus;
use App\Models\NewsletterTodayHeadline;
use Illuminate\Database\Eloquent\Collection;

class NewsletterTodayHeadlineRepository
{
    public function getNewsletterTodayHeadlines(): Collection|array
    {
        $publication_status_on_the_air = NewsletterPublicationStatus::onTheAir()
            ->first();

        /** @var NewsletterTodayHeadline $newsletter_today_headlines */
        $newsletter_today_headlines = NewsletterTodayHeadline::query()
            ->select("newsletter_today_headlines.id", "newsletter_today_headlines.order")
            ->addSelect( "newsletters.title",  "newsletters.slug")
            ->addSelect("newsletter_publication_statuses.name as status_name", "newsletter_publication_statuses.code as status_code")
            ->addSelect(  "morph_images.path as path")
            ->join("newsletters", function ($join) use ($publication_status_on_the_air) {
                $join->on("newsletters.id", "=", "newsletter_today_headlines.newsletter_id")
                    ->join("morph_images", function ($sub_join) {
                        $sub_join->on("morph_images.imageable_id", "=", "newsletters.id")
                            ->where("morph_images.imageable_type", "=", Newsletter::class)
                            ->where("morph_images.image_type", "=", MorphImageImageTypeEnum::COVER);
                    })
                    ->join("newsletter_publication_statuses", function ($sub_join) use ($publication_status_on_the_air) {
                        $sub_join->on("newsletter_publication_statuses.id", "=", "newsletters.newsletter_publication_status_id")
                            ->where("newsletter_publication_statuses.code", "=", $publication_status_on_the_air->code);
                    })
                    ->join("categories", function ($sub_join) {
                        $sub_join->on("categories.id", "=", "newsletters.category_id");
                    })
                    ->join("newsletter_sources", function ($sub_join) {
                        $sub_join->on("newsletter_sources.id", "=", "newsletters.newsletter_source_id");
                    });
            })
            ->limit(8)
            ->orderByDesc("newsletter_today_headlines.order")
            ->whereNull("newsletter_today_headlines.deleted_at")
            ->get();

        return $newsletter_today_headlines;
    }
}

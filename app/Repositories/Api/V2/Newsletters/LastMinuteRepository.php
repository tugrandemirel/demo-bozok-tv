<?php

namespace App\Repositories\Api\V2\Newsletters;

use App\Enum\MorphImage\MorphImageImageTypeEnum;
use App\Models\Newsletter;
use App\Models\NewsletterLastMinute;
use App\Models\NewsletterPublicationStatus;
use Illuminate\Database\Eloquent\Collection;

class LastMinuteRepository
{
    public function getLastMinutes(): Collection|array
    {
        $publication_status_on_the_air = NewsletterPublicationStatus::onTheAir()
            ->first();

        $newsletter_last_minutes = NewsletterLastMinute::query()
            ->select("newsletter_last_minutes.id", "newsletter_last_minutes.order")
            ->addSelect( "newsletters.title",  "newsletters.slug")
            ->addSelect("newsletter_publication_statuses.name as status_name", "newsletter_publication_statuses.code as status_code")
            ->addSelect(  "morph_images.path as path")
            ->join("newsletters", function ($join) use ($publication_status_on_the_air) {
                $join->on("newsletters.id", "=", "newsletter_last_minutes.newsletter_id")
                    ->join("morph_images", function ($sub_join)  {
                        $sub_join->on("morph_images.imageable_id", "=", "newsletters.id")
                            ->where("morph_images.imageable_type", "=", Newsletter::class)
                            ->where("morph_images.image_type", "=", MorphImageImageTypeEnum::COVER);
                    })
                    ->join("newsletter_publication_statuses", function ($sub_join) use ($publication_status_on_the_air) {
                        $sub_join->on("newsletter_publication_statuses.id", "=", "newsletters.newsletter_publication_status_id")
                            ->where("newsletter_publication_statuses.code", "=", $publication_status_on_the_air?->code);
                    })
                    ->join("categories", function ($sub_join) {
                        $sub_join->on("categories.id", "=", "newsletters.category_id");
                    })
                    ->join("newsletter_sources", function ($sub_join) {
                        $sub_join->on("newsletter_sources.id", "=", "newsletters.newsletter_source_id");
                    });
            })
            ->limit(4)
            ->orderByDesc("newsletter_last_minutes.order")
            ->get();

        return $newsletter_last_minutes;
    }
}

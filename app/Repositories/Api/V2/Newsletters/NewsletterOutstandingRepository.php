<?php

namespace App\Repositories\Api\V2\Newsletters;

use App\Enum\MorphImage\MorphImageImageTypeEnum;
use App\Models\Newsletter;
use App\Models\NewsletterLastMinute;
use App\Models\NewsletterOutstanding;
use Illuminate\Database\Eloquent\Collection;

class NewsletterOutstandingRepository
{
    public function getNewsletterOutstandings(): Collection|array
    {

        $newsletter_outstandings = NewsletterOutstanding::query()
            ->select("newsletter_outstandings.id", "newsletter_outstandings.order")
            ->addSelect( "newsletters.title",  "newsletters.slug")
            ->addSelect("newsletter_publication_statuses.name as status_name", "newsletter_publication_statuses.code as status_code")
            ->addSelect(  "morph_images.path as path")
            ->join("newsletters", function ($join) {
                $join->on("newsletters.id", "=", "newsletter_outstandings.newsletter_id")
                    ->join("morph_images", function ($sub_join) {
                        $sub_join->on("morph_images.imageable_id", "=", "newsletters.id")
                            ->where("morph_images.imageable_type", "=", Newsletter::class)
                            ->where("morph_images.image_type", "=", MorphImageImageTypeEnum::COVER);
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
            ->limit(4)
            ->orderByDesc("newsletter_outstandings.order")
            ->get();

        return $newsletter_outstandings;
    }
}

<?php

namespace App\Repositories\Api\V2\Newsletters;

use App\Enum\MorphImage\MorphImageImageTypeEnum;
use App\Models\Newsletter;
use App\Models\NewsletterFiveCuff;

class NewsletterFiveCuffRepository
{
    public function getFiveCuffs()
    {
        $newsletter_five_cuffs = NewsletterFiveCuff::query()
            ->select("newsletter_five_cuffs.id", "newsletter_five_cuffs.order")
            ->addSelect( "newsletters.title",  "newsletters.slug")
            ->addSelect("newsletter_publication_statuses.name as status_name", "newsletter_publication_statuses.code as status_code")
            ->addSelect(  "morph_images.path as path")
            ->join("newsletters", function ($join) {
                $join->on("newsletters.id", "=", "newsletter_five_cuffs.newsletter_id")
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
            ->limit(5)
            ->orderByDesc("newsletter_five_cuffs.order")
            ->get();

        return $newsletter_five_cuffs;
    }
}

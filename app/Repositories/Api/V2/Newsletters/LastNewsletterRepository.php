<?php

namespace App\Repositories\Api\V2\Newsletters;

use App\Enum\MorphImage\MorphImageImageTypeEnum;
use App\Models\Newsletter;
use Illuminate\Database\Eloquent\Collection;

class LastNewsletterRepository
{
    public function getLastNewsletters(): Collection|array
    {
        $last_newsletters = Newsletter::query()
            ->addSelect( "newsletters.title",  "newsletters.slug")
            ->addSelect("newsletter_publication_statuses.name as status_name", "newsletter_publication_statuses.code as status_code")
            ->addSelect(  "morph_images.path as path")
            ->join("morph_images", function ($join) {
                    $join->on("morph_images.imageable_id", "=", "newsletters.id")
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
            })
            ->limit(12)
            ->orderByDesc("newsletters.order")
            ->get();

        return $last_newsletters;
    }
}

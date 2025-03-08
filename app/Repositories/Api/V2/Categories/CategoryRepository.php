<?php

namespace App\Repositories\Api\V2\Categories;

use App\Enum\Category\CategoryHomePageEnum;
use App\Enum\Category\CategoryIsActiveEnum;
use App\Enum\MorphImage\MorphImageImageTypeEnum;
use App\Models\Category;
use App\Models\Newsletter;
use App\Models\NewsletterLastMinute;
use App\Models\NewsletterOutstanding;
use Illuminate\Database\Eloquent\Collection;

class CategoryRepository
{
    public function getAllHomeCategories()
    {
        $categories = Category::query()
            ->where("is_active", CategoryIsActiveEnum::ACTIVE)
            ->where("home_page", CategoryHomePageEnum::ACTIVE)
            ->get();

        return $categories;
    }

    public function getSlugByOutstandings(string $slug)
    {
        $category = Category::query()
            ->select("slug")
            ->where("slug", $slug)
            ->first();

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
            ->where("categories.slug", $category->slug)
            ->limit(5)
            ->orderBy("newsletter_outstandings.order", "desc")
            ->get();

        return $newsletter_outstandings;
    }
}

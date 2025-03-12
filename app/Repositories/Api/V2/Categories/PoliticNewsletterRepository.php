<?php

namespace App\Repositories\Api\V2\Categories;

use App\Enum\MorphImage\MorphImageImageTypeEnum;
use App\Models\Ads;
use App\Models\Category;
use App\Models\MainHeadline;
use App\Models\Newsletter;
use App\Models\NewsletterOutstanding;
use App\Models\NewsletterPublicationStatus;
use App\Models\NewsletterTodayHeadline;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class PoliticNewsletterRepository
{
    public function getPoliticNewslettersWithOutstanding(): Collection|array
    {
        $politic_category  = Category::query()
            ->select("id", "slug")
            ->politic()
            ->first();

        $publication_status_on_the_air = NewsletterPublicationStatus::onTheAir()
            ->first();

        $newsletter_outstanding =  NewsletterOutstanding::query()
            ->select("newsletter_outstandings.id", "newsletter_outstandings.order")
            ->addSelect( "newsletters.title",  "newsletters.slug")
            ->addSelect("newsletter_publication_statuses.name as status_name", "newsletter_publication_statuses.code as status_code")
            ->addSelect(  "morph_images.path as path")
            ->join("newsletters", function ($join) use ($politic_category, $publication_status_on_the_air) {
                $join->on("newsletters.id", "=", "newsletter_outstandings.newsletter_id")
                    ->join("morph_images", function ($sub_join) use ($politic_category) {
                        $sub_join->on("morph_images.imageable_id", "=", "newsletters.id")
                            ->where("morph_images.imageable_type", "=", Newsletter::class)
                            ->where("morph_images.image_type", "=", MorphImageImageTypeEnum::COVER);
                    })
                    ->join("newsletter_publication_statuses", function ($sub_join) use ($publication_status_on_the_air) {
                        $sub_join->on("newsletter_publication_statuses.id", "=", "newsletters.newsletter_publication_status_id")
                            ->where("newsletter_publication_statuses.code", "=", $publication_status_on_the_air->code);
                    })
                    ->join("categories", function ($sub_join) use ($politic_category) {
                        $sub_join->on("categories.id", "=", "newsletters.category_id")
                            ->where("categories.id", $politic_category->id);
                    })
                    ->join("newsletter_sources", function ($sub_join) {
                        $sub_join->on("newsletter_sources.id", "=", "newsletters.newsletter_source_id");
                    });
            })
            ->limit(4)
            ->orderByDesc("newsletter_outstandings.order")
            ->get();

        return $newsletter_outstanding;
    }

    public function getPoliticNewslettersWithTodayHeadlines(): Collection|array
    {
        $politic_category  = Category::query()
            ->select("id", "slug")
            ->politic()
            ->first();

        $publication_status_on_the_air = NewsletterPublicationStatus::onTheAir()
            ->first();

        $newsletter_today_headlines =  NewsletterTodayHeadline::query()
            ->select("newsletter_today_headlines.id", "newsletter_today_headlines.order")
            ->addSelect( "newsletters.title",  "newsletters.slug")
            ->addSelect("newsletter_publication_statuses.name as status_name", "newsletter_publication_statuses.code as status_code")
            ->addSelect(  "morph_images.path as path")
            ->join("newsletters", function ($join) use ($politic_category, $publication_status_on_the_air) {
                $join->on("newsletters.id", "=", "newsletter_today_headlines.newsletter_id")
                    ->join("morph_images", function ($sub_join) use ($politic_category) {
                        $sub_join->on("morph_images.imageable_id", "=", "newsletters.id")
                            ->where("morph_images.imageable_type", "=", Newsletter::class)
                            ->where("morph_images.image_type", "=", MorphImageImageTypeEnum::COVER);
                    })
                    ->join("newsletter_publication_statuses", function ($sub_join) use ($publication_status_on_the_air) {
                        $sub_join->on("newsletter_publication_statuses.id", "=", "newsletters.newsletter_publication_status_id")
                            ->where("newsletter_publication_statuses.code", "=", $publication_status_on_the_air->code);
                    })
                    ->join("categories", function ($sub_join) use ($politic_category) {
                        $sub_join->on("categories.id", "=", "newsletters.category_id")
                            ->where("categories.id", $politic_category->id);
                    })
                    ->join("newsletter_sources", function ($sub_join) {
                        $sub_join->on("newsletter_sources.id", "=", "newsletters.newsletter_source_id");
                    });
            })
            ->limit(4)
            ->orderByDesc("newsletter_today_headlines.order")
            ->get();

        return $newsletter_today_headlines;
    }

    public function getPoliticNewslettersWithMainHeadlines(): Collection|array
    {
        /** @var NewsletterPublicationStatus $newsletter_publication_status */
        $newsletter_publication_status = NewsletterPublicationStatus::query()
            ->onTheAir()
            ->select("code")
            ->first();

        /** @var Mainheadline $main_headlines */
        $main_headlines = MainHeadline::query()
            ->select("headlineable_type", "headlineable_id", "order", "uuid")
            ->with('headlineable', function (MorphTo $morphTo) use ($newsletter_publication_status) {
                $morphTo->constrain([
                    Newsletter::class => function (Builder $qu) use ($newsletter_publication_status) {
                        $qu->select("id","title", "category_id", "newsletter_publication_status_id", "slug");
                        $qu->with([
                            'image' => function ($q) {
                                $q->where('image_type', MorphImageImageTypeEnum::COVER);
                            },
                            'seoSetting',
                            "category"=> function ($q) {
                                $q->where("slug", Category::query()->politic()->first()->slug);
                            }
                        ]);
                        $qu->whereHas("status", function ($q) use ($newsletter_publication_status){
                            $q->where("code", $newsletter_publication_status->code);
                        });
                    },
                    Ads::class => function ($qu) {
                        $qu->where('is_active', \App\Enum\Ads\AdsIsActiveEnum::ACTIVE);
                        $qu->with('image');
                    }
                ]);
            })
            ->limit(10)
            ->orderBy('order')
            ->get();

        return $main_headlines;
    }
}

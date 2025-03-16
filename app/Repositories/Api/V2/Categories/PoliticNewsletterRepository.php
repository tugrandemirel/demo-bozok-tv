<?php

namespace App\Repositories\Api\V2\Categories;

use App\Enum\Ads\AdsIsActiveEnum;
use App\Enum\Category\CategoryIsActiveEnum;
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
            ->addSelect(  "categories.slug as category_slug")
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
            ->addSelect(  "categories.slug as category_slug")
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
        $newsletter_publication_status = NewsletterPublicationStatus::query()
            ->onTheAir()
            ->select("code")
            ->first();

        // KATEGORİ SORGUSU (AKTİF VE POLİTİK)
        $category = Category::query()
            ->politic()
            ->where('is_active', CategoryIsActiveEnum::ACTIVE) // Scope'da yoksa ekleyin
            ->first();

        if (!$category) {
            return collect(); // Kategori yoksa boş dön
        }

        // ANA BAŞLIKLARI ÇEK
        $main_headlines = MainHeadline::query()
            ->select("headlineable_type", "headlineable_id", "order", "uuid")
            ->with(['headlineable' => function ($query) use ($newsletter_publication_status, $category) {
                $query->when($query instanceof Newsletter, function (Builder $q) use ($newsletter_publication_status, $category) {
                    $q->select("id", "title", "category_id", "newsletter_publication_status_id", "slug")
                        ->with(['image', 'seoSetting', 'category'])
                        ->whereHas("status", function ($q) use ($newsletter_publication_status) {
                            $q->where("code", $newsletter_publication_status->code);
                        })
                        ->where("category_id", $category->id); // Kategori ID ile doğrudan filtrele
                })->when($query instanceof Ads, function (Builder $q) {
                    $q->where('is_active', AdsIsActiveEnum::ACTIVE)
                        ->with('image');
                });
            }])
            ->whereHasMorph(
                'headlineable',
                [Newsletter::class, Ads::class],
                function (Builder $query, $type) use ($newsletter_publication_status, $category) {
                    if ($type === Newsletter::class) {
                        $query->where("category_id", $category->id)
                            ->whereHas("status", function ($q) use ($newsletter_publication_status) {
                                $q->where("code", $newsletter_publication_status->code);
                            });
                    } elseif ($type === Ads::class) {
                        $query->where('is_active', AdsIsActiveEnum::ACTIVE);
                    }
                }
            )
            ->limit(10)
            ->orderBy('order')
            ->get();

        return $main_headlines;
    }
}

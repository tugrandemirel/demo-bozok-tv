<?php

namespace App\Repositories\Api\V2\Categories;

use App\Enum\Ads\AdsIsActiveEnum;
use App\Enum\Category\CategoryHomePageEnum;
use App\Enum\Category\CategoryIsActiveEnum;
use App\Enum\MorphImage\MorphImageImageTypeEnum;
use App\Models\Ads;
use App\Models\Category;
use App\Models\MainHeadline;
use App\Models\Newsletter;
use App\Models\NewsletterLastMinute;
use App\Models\NewsletterOutstanding;
use App\Models\NewsletterPublicationStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\MorphTo;

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

    public function getMainHeadlines(string $category_slug)
    {
        $category = Category::query()
            ->where("slug", $category_slug)
            ->first();

        /** @var NewsletterPublicationStatus $newsletter_publication_status */
        $newsletter_publication_status = NewsletterPublicationStatus::query()
            ->onTheAir()
            ->select("code")
            ->first();

        /** @var Mainheadline $main_headlines */
        $main_headlines = MainHeadline::query()
            ->with(['headlineable' => function ($query) {
                $query->when($query instanceof Newsletter, function ($q) {
                    $q->select('id', 'title', 'slug', 'category_id', 'newsletter_publication_status_id')
                        ->without('content') // <-- Content'i hariç tut
                        ->with([
                            'image' => function ($subQuery) {
                                $subQuery->select('id', 'path', 'imageable_id', 'imageable_type');
                            },
                            'category:id,name,slug',
                            'status:id,code'
                        ]);
                })->when($query instanceof Ads, function ($q) {
                    $q->select('id', 'title', 'is_active')
                        ->with('image:id,url,imageable_id,imageable_type');
                });
            }])
            ->whereHasMorph(
                'headlineable',
                [Newsletter::class, Ads::class],
                function (Builder $query, $type) use ($category_slug, $newsletter_publication_status) {
                    if ($type === Newsletter::class) {
                        $query->select('id', 'title', 'slug', 'category_id', 'newsletter_publication_status_id');
                        $query->whereHas('category', function ($q) use ($category_slug) {
                            $q->where('slug', $category_slug)
                                ->where('is_active', CategoryIsActiveEnum::ACTIVE);
                        })->whereHas('status', function ($q) use ($newsletter_publication_status) {
                            $q->where('code', $newsletter_publication_status->code);
                        });
                    } elseif ($type === Ads::class) {
                        $query->where('is_active', AdsIsActiveEnum::ACTIVE);
                    }
                }
            )
            ->orderBy('order', 'desc')
            ->limit(20)
            ->get()
            ->map(function ($mainHeadline) {
                // Image ilişkisi boşsa null olarak ayarla
                if ($mainHeadline->headlineable instanceof Newsletter && !$mainHeadline->headlineable->image) {
                    $mainHeadline->headlineable->setRelation('image', null);
                }
                return $mainHeadline;
            });

        return $main_headlines;
    }

    public function getCategoryLastNewsletter(string $category_slug)
    {
        /** @var NewsletterPublicationStatus $newsletter_publication_status */
        $newsletter_publication_status = NewsletterPublicationStatus::query()
            ->onTheAir()
            ->select("code")
            ->first();

        $newsletters = Newsletter::query()
            ->select("newsletters.id", "newsletters.title", "newsletters.slug", "newsletters.created_at")
            ->addSelect(  "morph_images.path as path")
            ->join("morph_images", function ($join) {
                $join->on("morph_images.imageable_id", "=", "newsletters.id")
                    ->where("morph_images.imageable_type", "=", Newsletter::class)
                    ->where("morph_images.image_type", "=", MorphImageImageTypeEnum::COVER);
            })
            ->join("categories","categories.id", "=", "newsletters.category_id")
            ->join("newsletter_publication_statuses", "newsletter_publication_statuses.id", "=", "newsletters.newsletter_publication_status_id")
            ->where("categories.slug", $category_slug)
            ->where("newsletter_publication_statuses.code", $newsletter_publication_status?->code)
            ->limit(24)
            ->get();
dd($newsletters);
        return $newsletters;
    }
}

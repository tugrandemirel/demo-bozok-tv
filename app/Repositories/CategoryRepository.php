<?php

namespace App\Repositories;

use App\Enum\Category\CategoryHomePageEnum;
use App\Enum\Category\CategoryIsActiveEnum;
use App\Enum\MorphImage\MorphImageImageTypeEnum;
use App\Enum\Newsletter\NewsletterGeneralEnum;
use App\Interfaces\Repositories\CategoryRepositoryInterface;
use App\Models\Category;
use App\Models\Newsletter;
use App\Models\NewsletterPublicationStatus;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use function Amp\Dns\query;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function getCategories(Request $request): Collection|array
    {
        /** @var Category $categories */
        $categories = Category::query()
            ->select('name', "slug")
            ->where("is_active", CategoryIsActiveEnum::ACTIVE)
            ->where("home_page", CategoryHomePageEnum::ACTIVE)
            ->orderBy('order')
            ->get();

        return $categories;
    }

    public function getCategoryBySlugNewsletters(Request $request, $slug)
    {
        /** @var NewsletterPublicationStatus $newsletter_publication_status_on_the_air */
        $newsletter_publication_status_on_the_air = NewsletterPublicationStatus::query()
            ->select("code")
            ->onTheAir()
            ->first();

        /** @var NewsletterPublicationStatus $newsletter_publication_status_archive */
        $newsletter_publication_status_archive = NewsletterPublicationStatus::query()
            ->select("code")
            ->archive()
            ->first();


        /** @var LengthAwarePaginator $newsletters */
        $newsletters = Newsletter::query()
            ->select("newsletter_publication_status_id", "title", "slug", "id")
            ->whereRelation("category", "slug", "=", $slug)
//            ->where("is_outstanding", NewsletterGeneralEnum::ON)
//            ->where("is_today_headline", NewsletterGeneralEnum::ON)
            ->with([
                "status" => fn($query) => $query->whereIn('code', [$newsletter_publication_status_on_the_air->code, $newsletter_publication_status_archive->code]),
                "image" => function ($query) {
                    $query->select("path", "id", "imageable_id")
                        ->where("image_type", MorphImageImageTypeEnum::COVER);
                },
            ])
            ->orderBy('order')
            ->limit(20)
            ->get();

        return $newsletters;
    }

    public function getCategoryNewsletters(Request $request, string $slug)
    {
        /** @var NewsletterPublicationStatus $newsletter_publication_status_on_the_air */
        $newsletter_publication_status_on_the_air = NewsletterPublicationStatus::query()
            ->select("code")
            ->onTheAir()
            ->first();

        /** @var NewsletterPublicationStatus $newsletter_publication_status_archive */
        $newsletter_publication_status_archive = NewsletterPublicationStatus::query()
            ->select("code")
            ->archive()
            ->first();

        /** @var LengthAwarePaginator $newsletters */
        $newsletters = Newsletter::query()
            ->select("newsletter_publication_status_id", "title", "slug", "id")
            ->whereRelation("category", "slug", "=", $slug)
//            ->where("is_outstanding", NewsletterGeneralEnum::ON)
//            ->where("is_today_headline", NewsletterGeneralEnum::ON)
            ->with([
                "status" => fn($query) => $query->whereIn('code', [$newsletter_publication_status_on_the_air->code, $newsletter_publication_status_archive->code]),
                "image" => function ($query) {
                    $query->select("path", "id", "imageable_id")
                        ->where("image_type", MorphImageImageTypeEnum::COVER);
                },
            ])
            ->orderBy('order')
            ->limit(9)
            ->get();

        return $newsletters;
    }

    public function getRelatedNewsletters(Request $request, string $slug)
    {

        /** @var NewsletterPublicationStatus $newsletter_publication_status_on_the_air */
        $newsletter_publication_status_on_the_air = NewsletterPublicationStatus::query()
            ->select("code")
            ->onTheAir()
            ->first();

        /** @var NewsletterPublicationStatus $newsletter_publication_status_archive */
        $newsletter_publication_status_archive = NewsletterPublicationStatus::query()
            ->select("code")
            ->archive()
            ->first();

        /** @var LengthAwarePaginator $newsletters */
        $newsletters = Newsletter::query()
            ->select("newsletter_publication_status_id", "title", "slug", "id")
            ->whereRelation("category", "slug", "=", $slug)
//            ->where("is_outstanding", NewsletterGeneralEnum::ON)
//            ->where("is_today_headline", NewsletterGeneralEnum::ON)
            ->with([
                "status" => fn($query) => $query->whereIn('code', [$newsletter_publication_status_on_the_air->code, $newsletter_publication_status_archive->code]),
                "image" => function ($query) {
                    $query->select("path", "id", "imageable_id")
                        ->where("image_type", MorphImageImageTypeEnum::COVER);
                },
            ])
            ->orderBy('order')
            ->limit(6)
            ->get();

        return $newsletters;
    }

    public function getCategory(string $slug)
    {
        /** @var Category $category */
        $category = Category::query()
            ->select("name", "slug")
            ->where("slug", $slug)
            ->where("is_active", CategoryIsActiveEnum::ACTIVE)
            ->first();

        return $category;
    }

    public function getCategoryBySlugNewsletter($slug)
    {
        $newsletter = Newsletter::query()
            ->whereRelation("category", "slug", "=", $slug)
            ->with([
                "image" => function ($query) {
                    $query->select("path", "id", "imageable_id")
                        ->where("image_type", MorphImageImageTypeEnum::COVER);
                },
                "seoSetting",
                "source"
            ])
            ->whereHas("category", function ($query) {
                $query->where("is_active", CategoryIsActiveEnum::ACTIVE);
            })
            ->whereHas("status", function ($query) {
                $query->where("code", NewsletterPublicationStatus::onTheAir()->code);
            })
            ->where("is_outstanding", NewsletterGeneralEnum::ON)
            ->orderBy('order')
            ->limit(3)
            ->get();

        return $newsletter;
    }
}

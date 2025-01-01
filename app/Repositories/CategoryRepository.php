<?php

namespace App\Repositories;

use App\Enum\Category\CategoryHomePageEnum;
use App\Enum\Category\CategoryIsActiveEnum;
use App\Interfaces\Repositories\CategoryRepositoryInterface;
use App\Models\Category;
use App\Models\Newsletter;
use App\Models\NewsletterPublicationStatus;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

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

    public function getCategoryNewsletters(Request $request, string $slug): LengthAwarePaginator
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
            ->withRelation("category", "slug", "=", $slug)
            ->with([
                "status" => fn($query) => $query->whereIn('code', [$newsletter_publication_status_on_the_air->code, $newsletter_publication_status_archive->code])
            ])
            ->orderBy('order')
            ->limit(20)
            ->get();

        return $newsletters;
    }
}

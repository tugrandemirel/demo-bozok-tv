<?php

namespace App\Service\Api\V2\Categories;

use App\Http\Resources\Api\V2\Categories\CategoryResource;
use App\Http\Resources\Api\V2\Newsletters\LastMinuteResource;
use App\Http\Resources\Api\V2\Newsletters\LastNewsletterResource;
use App\Http\Resources\MainHeadlineResource;
use App\Http\Resources\NewsletterResource;
use App\Repositories\Api\V2\Categories\CategoryRepository;
use App\Repositories\Api\V2\Newsletters\LastMinuteRepository;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CategoryService
{
    private CategoryRepository $category_repository;
    public function __construct(CategoryRepository $category_repository)
    {
        $this->category_repository = $category_repository;
    }

    public function getAllHomeCategories(): AnonymousResourceCollection
    {
        $categories = $this->category_repository->getAllHomeCategories();

        return CategoryResource::collection($categories);
    }

    public function getSlugByOutstandings(string $slug)
    {
        $categories = $this->category_repository->getSlugByOutstandings($slug);
        return CategoryResource::collection($categories);
    }

    public function getCategoryMainHeadlines(string $category_slug)
    {
        $main_headlines = $this->category_repository->getMainHeadlines($category_slug);
        return MainHeadlineResource::collection($main_headlines);
    }

    public function getCategoryNewsletters(string $category_slug)
    {
        $newsletters = $this->category_repository->getCategoryLastNewsletter($category_slug);
        return LastNewsletterResource::collection($newsletters);
    }
}

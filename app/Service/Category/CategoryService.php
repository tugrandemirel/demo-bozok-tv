<?php

namespace App\Service\Category;

use App\Http\Resources\CategoryResource;
use App\Http\Resources\NewsletterResource;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CategoryService
{
    protected CategoryRepository $category_repository;

    public function __construct(CategoryRepository $category_repository)
    {
        $this->category_repository = $category_repository;
    }

    public function getCategories(Request $request): AnonymousResourceCollection
    {
        $categories = $this->category_repository->getCategories($request);
        return CategoryResource::collection($categories);
    }

    public function getCategoryNewsletters(Request $request, string $slug)
    {
        $newsletters = $this->category_repository->getCategoryNewsletters($request, $slug);
        return NewsletterResource::collection($newsletters);
    }
}

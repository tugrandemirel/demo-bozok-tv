<?php

namespace App\Service\Api\V2\Categories;

use App\Http\Resources\Api\V2\Categories\CategoryResource;
use App\Http\Resources\Api\V2\Newsletters\LastMinuteResource;
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
}

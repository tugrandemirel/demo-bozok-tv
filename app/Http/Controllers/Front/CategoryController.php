<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Service\Api\V2\Categories\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private CategoryService $category_service;
    public function __construct(CategoryService $category_service)
    {
        $this->category_service = $category_service;
    }

    public function show($category_slug)
    {
        try {
            /** @var CategoryService $category */
            $category = $this->category_service->getCategoryBySlug($category_slug);
            $main_headlines = $this->category_service->getCategoryMainHeadlines($category_slug);
            $newsletters = $this->category_service->getCategoryNewsletters($category_slug);
            return view("front.category.show", compact('category', "main_headlines", "newsletters"));
        }
        catch (\Exception $exception) {
            abort(404);
        }
    }
}

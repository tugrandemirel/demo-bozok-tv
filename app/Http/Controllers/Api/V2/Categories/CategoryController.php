<?php

namespace App\Http\Controllers\Api\V2\Categories;

use App\Helpers\Response\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Service\Api\V2\Categories\CategoryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private CategoryService $category_service;

    public function __construct(CategoryService $category_service)
    {
        $this->category_service = $category_service;
    }

    public function getHomeCategories(): JsonResponse
    {
        try{
            $categories = $this->category_service->getAllHomeCategories();
            return ResponseHelper::success("Kategoriler başarılı bir şekilde çekildi.", ["data" => $categories], 200);
        } catch (\Exception $exception) {
            return ResponseHelper::error("Kategori çekme işleminde bir hata ile karşılaşıldı.", $exception->getMessage() );
        }
    }

    public function getSlugByOutstandings(string $slug): JsonResponse
    {
        try {
            $categories = $this->category_service->getSlugByOutstandings($slug);
            return ResponseHelper::success("Slug'a göre öne çıkan haberleri çekme işlemi başarılı bir şekilde gerçekleştirildi.", ["data" => $categories], 200);
        } catch (\Exception $exception) {
            return ResponseHelper::error("Slug'a göre öne çıkan haberleri çekme işleminde bir hata ile karşılaşıldı.", $exception->getMessage() );
        }
    }

    public function getMainHeadlines(string $category_slug)
    {
        try{
            $main_headlines = $this->category_service->getCategoryMainHeadlines($category_slug);
            return ResponseHelper::success("Kategori Ana Maşneti başarılı bir şekilde çekildi.", ["data" => $main_headlines], 200);
        } catch (\Exception $exception) {
            return ResponseHelper::error("Kategori Ana Manşeti çekme işleminde bir hata ile karşılaşıldı.", $exception->getMessage() );
        }
    }

    public function getCategoryLastNewsletters(string $category_slug)
    {
        try{
            $newsletters = $this->category_service->getCategoryNewsletters($category_slug);
            return ResponseHelper::success("Kategori ait son haberler başarılı bir şekilde çekildi.", ["data" => $newsletters], 200);
        } catch (\Exception $exception) {
            return ResponseHelper::error("Kategori ait son haberler çekme işleminde bir hata ile karşılaşıldı.", $exception->getMessage() );
        }
    }
}

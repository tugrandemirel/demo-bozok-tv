<?php

namespace App\Http\Controllers\Api\V1;

use App\Helpers\Response\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Service\Category\CategoryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Mockery\Exception;

class CategoryApiController extends Controller
{
    private CategoryService $category_service;
    public function __construct(CategoryService $category_service)
    {
        $this->category_service = $category_service;
    }

    public function index(Request $request): JsonResponse
    {
        try {
            /** @var CategoryService $categories */
            $categories = $this->category_service->getCategories($request);
            return ResponseHelper::success("Kategoriler başarılı bir şekilde çekildi.", ['data' => $categories], 200);
        } catch (Exception $exception) {
            return ResponseHelper::error("Bir hata oluştu.", [$exception->getMessage()]);
        }

    }

    public function getCategoryNewsletters(Request $request, string $slug): JsonResponse
    {
        try {
            /** @var CategoryService $newsletters */
            $newsletters = $this->category_service->getCategoryNewsletters($request, $slug);
            return ResponseHelper::success("Kategoriye bağlı haberler başarılı bir şekilde çekildi.", ['data' => $newsletters], 200);
        } catch (\Exception $exception) {
            return ResponseHelper::error("Bir hata oluştu.", [$exception->getMessage()]);
        }
    }

    public function show(Request $request, string $slug)
    {

    }

    public function relatedNewsletters(Request $request, string $slug): JsonResponse
    {
        try {
            $newsletters = $this->category_service->getRelatedNewsletters($request, $slug);
            return ResponseHelper::success("Kategoriye bağlı haberler başarılı bir şekilde çekildi.", ['data' => $newsletters], 200);
        } catch (\Exception $exception) {
            return ResponseHelper::error("Bir hata oluştu.", [$exception->getMessage()]);
        }
    }
}

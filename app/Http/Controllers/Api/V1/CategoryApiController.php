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
}

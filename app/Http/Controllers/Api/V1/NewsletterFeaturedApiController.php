<?php

namespace App\Http\Controllers\Api\V1;

use App\Helpers\Response\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Service\Newsletter\NewsletterService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NewsletterFeaturedApiController extends Controller
{
    private NewsletterService $newsletter_service;

    public function __construct(NewsletterService $newsletter_service)
    {
        $this->newsletter_service = $newsletter_service;
    }

    public function index(Request $request): JsonResponse
    {
        try {
            $featured_news = $this->newsletter_service->getFeaturedNews($request);
            return ResponseHelper::success("Öne Çıkanlar Başarılı bir şekilde çekildi.", ['data' => $featured_news], 200);
        } catch (\Exception $exception) {
            return ResponseHelper::error("Bir hata oluştu.", [$exception->getMessage()]);
        }
    }
}

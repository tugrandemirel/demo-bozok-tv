<?php

namespace App\Http\Controllers\Api\V2\Newsletters;

use App\Helpers\Response\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Service\Api\V2\Newsletters\NewsletterTodayHeadlineService;
use Illuminate\Http\JsonResponse;

class NewsletterTodayHeadlineController extends Controller
{
    private NewsletterTodayHeadlineService $newsletter_today_headline_service;

    public function __construct(NewsletterTodayHeadlineService $newsletter_today_headline_service)
    {
        $this->newsletter_today_headline_service = $newsletter_today_headline_service;
    }

    public function index(): JsonResponse
    {
        try {
            $newsletter_today_headline_service = $this->newsletter_today_headline_service->getNewsletterTodayHeadlines();

            return ResponseHelper::success("Günün manşeti başarılı bir şekilde çekildi.", ["data" => $newsletter_today_headline_service], 200);
        } catch (\Exception $exception) {
            return ResponseHelper::error("Günün manşeti çekilirken bir hata oluştu", [$exception->getMessage()]);
        }
    }
}

<?php

namespace App\Http\Controllers\Api\V1;

use App\Helpers\Response\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Service\Newsletter\NewsletterService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Mockery\Exception;

class NewsletterTodayHeadlineApiController extends Controller
{
    private NewsletterService $newsletter_service;

    public function __construct (NewsletterService $newsletter_service)
    {
        $this->newsletter_service = $newsletter_service;
    }

    public function index(): JsonResponse
    {
        try {
            $newsletters = $this->newsletter_service->getTodayHeadlineNewsletters();
            return ResponseHelper::success("Günün Manşeti Başarılı bir şekilde çekildi.", ['data' => $newsletters], 200);
        } catch (Exception $exception) {
            return ResponseHelper::error("Bir hata oluştu.", [$exception->getMessage()]);
        }
    }
}

<?php

namespace App\Http\Controllers\Api\V1;

use App\Helpers\Response\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Service\Newsletter\NewsletterService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Mockery\Exception;

class NewsletterLastMinuteApiController extends Controller
{
    protected NewsletterService $newsletter_service;
    public function __construct(NewsletterService $newsletter_service)
    {
        $this->newsletter_service = $newsletter_service;
    }

    public function index(): JsonResponse
    {
        try {
            $last_minute_newsletters = $this->newsletter_service->getLastMinuteNewsletters();
            return ResponseHelper::success("Ana Manşet Başarılı bir şekilde çekildi.", ['data' => $last_minute_newsletters], 200);
        } catch (Exception $exception) {
            return ResponseHelper::error("Bir hata oluştu.", [$exception->getMessage()]);
        }
    }
}

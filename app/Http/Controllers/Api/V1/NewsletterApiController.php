<?php

namespace App\Http\Controllers\Api\V1;

use App\Helpers\Response\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Service\Newsletter\NewsletterService;
use Illuminate\Http\Request;
use Mockery\Exception;

class NewsletterApiController extends Controller
{
    protected NewsletterService $newsletter_service;
    public function __construct(NewsletterService $newsletter_service)
    {
        $this->newsletter_service = $newsletter_service;
    }

    public function show($slug)
    {
        try {
            $newsletter = $this->newsletter_service->getNewsletter($slug);
            return ResponseHelper::success("Ana Manşet Başarılı bir şekilde çekildi.", ['data' => $newsletter], 200);
        } catch (Exception $exception) {
            return ResponseHelper::error("Bir hata oluştu.", [$exception->getMessage()]);
        }
    }
}

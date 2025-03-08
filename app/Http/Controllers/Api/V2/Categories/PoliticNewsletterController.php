<?php

namespace App\Http\Controllers\Api\V2\Categories;

use App\Helpers\Response\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Service\Api\V2\Categories\PoliticNewsletterService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PoliticNewsletterController extends Controller
{
    private PoliticNewsletterService $politic_newsletter_service;
    public function __construct(PoliticNewsletterService $politic_newsletter_service)
    {
        $this->politic_newsletter_service = $politic_newsletter_service;
    }

    public function getPoliticNewslettersWithOutstanding(): JsonResponse
    {
        $politic_newsletters = $this->politic_newsletter_service->getPoliticNewslettersWithOutstanding();
        return ResponseHelper::success("Siyaset Haberleri başarılu bir şekilde çekildi.", ["data" => $politic_newsletters]);
    }

    public function getPoliticNewslettersWithTodayHeadlines(): JsonResponse
    {
        $newsletter_today_headlines = $this->politic_newsletter_service->getPoliticNewslettersWithTodayHeadlines();
        return ResponseHelper::success("Siyaset Haberleri başarılu bir şekilde çekildi.", ["data" => $newsletter_today_headlines]);
    }

    public function getPoliticNewslettersWithMainHeadlines(): JsonResponse
    {
        $newsletter_today_headlines = $this->politic_newsletter_service->getPoliticNewslettersWithMainHeadlines();
        return ResponseHelper::success("Siyaset Haberleri başarılu bir şekilde çekildi.", ["data" => $newsletter_today_headlines]);
    }
}

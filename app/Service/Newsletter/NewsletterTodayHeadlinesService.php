<?php

namespace App\Service\Newsletter;

use App\Http\Requests\Admin\Newsletter\NewsletterFilterRequest;
use App\Repositories\NewsletterOutstandingsRepository;
use App\Repositories\NewsletterTodayHeadlinesRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class NewsletterTodayHeadlinesService
{
    private NewsletterTodayHeadlinesRepository $newsletter_today_headline_repository;
    public function __construct(NewsletterTodayHeadlinesRepository $newsletter_today_headline_repository)
    {
        $this->newsletter_today_headline_repository = $newsletter_today_headline_repository;
    }

    public function getTodayHeadlineForDatatable(NewsletterFilterRequest|Request $request): JsonResponse
    {
        $newsletter_today_headlines = $this->newsletter_today_headline_repository->getTodayHeadlinesForDatatable($request);

        return DataTables::eloquent($newsletter_today_headlines)->toJson();
    }
}

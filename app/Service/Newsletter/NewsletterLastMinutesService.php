<?php

namespace App\Service\Newsletter;

use App\Http\Requests\Admin\Newsletter\NewsletterFilterRequest;
use App\Repositories\NewsletterLastMinuteRepository;
use App\Repositories\NewsletterOutstandingsRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class NewsletterLastMinutesService
{
    private NewsletterLastMinuteRepository $newsletter_last_minutes_repository;
    public function __construct(NewsletterLastMinuteRepository $newsletter_last_minutes_repository)
    {
        $this->newsletter_last_minutes_repository = $newsletter_last_minutes_repository;
    }

    public function getLastMinuteForDatatable(NewsletterFilterRequest|Request $request): JsonResponse
    {
        $newsletter_last_minutes = $this->newsletter_last_minutes_repository->getLastMinuteForDatatable($request);

        return DataTables::eloquent($newsletter_last_minutes)->toJson();
    }
}

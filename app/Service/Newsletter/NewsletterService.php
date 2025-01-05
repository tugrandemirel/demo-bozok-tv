<?php

namespace App\Service\Newsletter;

use App\Http\Requests\Admin\Newsletter\NewsletterFilterRequest;
use App\Http\Resources\Admin\Newsletter\NewsletterResource;
use App\Interfaces\Repositories\NewsletterRepositoryInterface;
use App\Models\Newsletter;
use App\Repositories\NewsletterRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class NewsletterService implements NewsletterRepositoryInterface
{

    private NewsletterRepository $newsletter_repository;

    public function __construct(NewsletterRepository $newsletter_repository)
    {
        $this->newsletter_repository = $newsletter_repository;
    }

    /**
     * @throws \Exception
     */
    public function getAllDataForDatatable(NewsletterFilterRequest|Request $request): JsonResponse
    {
        $newsletters =  $this->newsletter_repository->getAllDataForDatatable($request);

        return DataTables::of(NewsletterResource::collection($newsletters))->make(true);
    }

    public function getMainHeadlines()
    {

    }

    public function getLastMinuteNewsletters(): AnonymousResourceCollection
    {
        $last_minutes_newsletters = $this->newsletter_repository->getLastMinuteNewsletters();

        return \App\Http\Resources\NewsletterResource::collection($last_minutes_newsletters);
    }

    public function getFeaturedNews(Request $request): AnonymousResourceCollection
    {
        $featured_news = $this->newsletter_repository->getFeaturedNews($request);
        return \App\Http\Resources\NewsletterResource::collection($featured_news);
    }
}

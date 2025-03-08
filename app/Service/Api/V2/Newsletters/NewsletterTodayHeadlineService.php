<?php

namespace App\Service\Api\V2\Newsletters;

use App\Http\Resources\Api\V2\Newsletters\NewsletterTodayHeadlineResource;
use App\Repositories\Api\V2\Newsletters\NewsletterTodayHeadlineRepository;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class NewsletterTodayHeadlineService
{
    private NewsletterTodayHeadlineRepository $newsletter_today_headline_repository;

    public function __construct(NewsletterTodayHeadlineRepository $newsletter_today_headline_repository)
    {
        $this->newsletter_today_headline_repository = $newsletter_today_headline_repository;
    }

    public function getNewsletterTodayHeadlines(): AnonymousResourceCollection
    {
        $newsletter_today_headline_repository = $this->newsletter_today_headline_repository->getNewsletterTodayHeadlines();

        return NewsletterTodayHeadlineResource::collection($newsletter_today_headline_repository);
    }
}

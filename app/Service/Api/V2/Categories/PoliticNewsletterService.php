<?php

namespace App\Service\Api\V2\Categories;

use App\Http\Resources\Api\V2\Categories\PoliticNewsletterResource;
use App\Repositories\Api\V2\Categories\PoliticNewsletterRepository;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PoliticNewsletterService
{
    private PoliticNewsletterRepository $politic_newsletter_repository;
    public function __construct(PoliticNewsletterRepository $politic_newsletter_repository)
    {
        $this->politic_newsletter_repository = $politic_newsletter_repository;
    }

    public function getPoliticNewslettersWithOutstanding(): AnonymousResourceCollection
    {
        $newsletter_outstandings = $this->politic_newsletter_repository->getPoliticNewslettersWithOutstanding();

        return PoliticNewsletterResource::collection($newsletter_outstandings);
    }

    public function getPoliticNewslettersWithTodayHeadlines(): AnonymousResourceCollection
    {
        $newsletter_today_headlines = $this->politic_newsletter_repository->getPoliticNewslettersWithTodayHeadlines();

        return PoliticNewsletterResource::collection($newsletter_today_headlines);
    }

    public function getPoliticNewslettersWithMainHeadlines(): AnonymousResourceCollection
    {
        $newsletter_main_headlines = $this->politic_newsletter_repository->getPoliticNewslettersWithMainHeadlines();

        return PoliticNewsletterResource::collection($newsletter_main_headlines);
    }
}

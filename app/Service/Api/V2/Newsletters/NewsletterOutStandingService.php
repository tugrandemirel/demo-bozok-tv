<?php

namespace App\Service\Api\V2\Newsletters;

use App\Http\Resources\Api\V2\Newsletters\LastMinuteResource;
use App\Http\Resources\Api\V2\Newsletters\NewsletterOutstandingResource;
use App\Repositories\Api\V2\Newsletters\LastMinuteRepository;
use App\Repositories\Api\V2\Newsletters\NewsletterOutstandingRepository;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class NewsletterOutStandingService
{
    private NewsletterOutstandingRepository $newsletter_outstandings_repository;
    public function __construct(NewsletterOutstandingRepository $newsletter_outstandings_repository)
    {
        $this->newsletter_outstandings_repository = $newsletter_outstandings_repository;
    }

    public function getNewsletterOutstandings(): AnonymousResourceCollection
    {
        $newsletter_outstandings = $this->newsletter_outstandings_repository->getNewsletterOutstandings();

        return NewsletterOutstandingResource::collection($newsletter_outstandings);
    }
}

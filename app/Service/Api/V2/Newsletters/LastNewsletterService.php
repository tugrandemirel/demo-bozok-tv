<?php

namespace App\Service\Api\V2\Newsletters;

use App\Http\Resources\Api\V2\Newsletters\LastNewsletterResource;
use App\Repositories\Api\V2\Newsletters\LastNewsletterRepository;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class LastNewsletterService
{
    private LastNewsletterRepository $last_minute_repository;
    public function __construct(LastNewsletterRepository $last_minute_repository)
    {
        $this->last_minute_repository = $last_minute_repository;
    }

    public function getLastNewsletters(): AnonymousResourceCollection
    {
        $last_minutes = $this->last_minute_repository->getLastNewsletters();

        return LastNewsletterResource::collection($last_minutes);
    }
}

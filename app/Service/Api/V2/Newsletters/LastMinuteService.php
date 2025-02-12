<?php

namespace App\Service\Api\V2\Newsletters;

use App\Http\Resources\Api\V2\Newsletters\LastMinuteResource;
use App\Http\Resources\Api\V2\Newsletters\LastNewsletterResource;
use App\Repositories\Api\V2\Newsletters\LastMinuteRepository;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class LastMinuteService
{
    private LastMinuteRepository $last_minutes_newsletters_repository;
    public function __construct(LastMinuteRepository $last_minutes_newsletters_repository)
    {
        $this->last_minutes_newsletters_repository = $last_minutes_newsletters_repository;
    }

    public function getLastMinutes(): AnonymousResourceCollection
    {
        $newsletter_five_cuffs = $this->last_minutes_newsletters_repository->getLastMinutes();

        return LastMinuteResource::collection($newsletter_five_cuffs);
    }
}

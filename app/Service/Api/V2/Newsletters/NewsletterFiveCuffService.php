<?php

namespace App\Service\Api\V2\Newsletters;

use App\Http\Resources\Api\V2\Newsletters\NewsletterFiveCuffResource;
use App\Repositories\Api\V2\Newsletters\NewsletterFiveCuffRepository;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class NewsletterFiveCuffService
{
    private NewsletterFiveCuffRepository $newsletter_five_cuff_repository;
    public function __construct(NewsletterFiveCuffRepository $newsletter_five_cuff_repository)
    {
        $this->newsletter_five_cuff_repository = $newsletter_five_cuff_repository;
    }

    public function getFiveCuffs(): AnonymousResourceCollection
    {
        $newsletter_five_cuffs = $this->newsletter_five_cuff_repository->getFiveCuffs();

        return NewsletterFiveCuffResource::collection($newsletter_five_cuffs);
    }
}

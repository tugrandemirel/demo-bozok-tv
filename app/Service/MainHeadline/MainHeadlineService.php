<?php

namespace App\Service\MainHeadline;

use App\Http\Resources\MainHeadlineResource;
use App\Repositories\MainHeadlineRepository;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class MainHeadlineService
{
    protected MainHeadlineRepository $main_headline_repository;

    public function __construct(MainHeadlineRepository $main_headline_repository)
    {
        $this->main_headline_repository = $main_headline_repository;
    }

    public function getMainHeadlines(): AnonymousResourceCollection
    {
        $mainHeadlines = $this->main_headline_repository->getMainHeadlines();
        return MainHeadlineResource::collection($mainHeadlines);
    }
}

<?php

namespace App\Service\Newsletter;

use App\Http\Requests\Admin\Newsletter\NewsletterFilterRequest;
use App\Http\Resources\Admin\Newsletter\NewsletterResource;
use App\Repositories\NewsletterOutstandingsRepository;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class NewsletterOutstandingsService
{
    private NewsletterOutstandingsRepository $newsletter_outstandings_repository;
    public function __construct(NewsletterOutstandingsRepository $newsletter_outstandings_repository)
    {
        $this->newsletter_outstandings_repository = $newsletter_outstandings_repository;
    }

    public function getOutstandingForDatatable(NewsletterFilterRequest|Request $request)
    {
        $newsletter_outstandings = $this->newsletter_outstandings_repository->getOutstandingForDatatable($request);

        return DataTables::eloquent($newsletter_outstandings)->toJson();
    }
}

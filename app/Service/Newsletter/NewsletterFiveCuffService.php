<?php

namespace App\Service\Newsletter;

use App\Http\Requests\Admin\Newsletter\NewsletterFilterRequest;
use App\Repositories\NewsletterFiveCuffRepository;
use App\Repositories\NewsletterOutstandingsRepository;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class NewsletterFiveCuffService
{
    private NewsletterFiveCuffRepository $newsletter_five_cuff_repository;
    public function __construct(NewsletterFiveCuffRepository $newsletter_five_cuff_repository)
    {
        $this->newsletter_five_cuff_repository = $newsletter_five_cuff_repository;
    }

    public function getFiveCuffsForDatatable(NewsletterFilterRequest|Request $request)
    {
        $newsletter_five_cuffs = $this->newsletter_five_cuff_repository->getFiveCuffsForDatatable($request);

        return DataTables::eloquent($newsletter_five_cuffs)->toJson();
    }
}

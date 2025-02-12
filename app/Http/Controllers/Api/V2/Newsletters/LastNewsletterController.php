<?php

namespace App\Http\Controllers\Api\V2\Newsletters;

use App\Helpers\Response\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Service\Api\V2\Newsletters\LastNewsletterService;
use Illuminate\Http\Request;

class LastNewsletterController extends Controller
{
    private LastNewsletterService $last_newsletter_service;
    public function __construct(LastNewsletterService $last_newsletter_service)
    {
        $this->last_newsletter_service = $last_newsletter_service;
    }

    public function index()
    {
        $last_newsletters = $this->last_newsletter_service->getLastNewsletters();

        return ResponseHelper::success("Son haberler başarılı bir şekilde çekildi.",  ["data" => $last_newsletters]);
    }
}

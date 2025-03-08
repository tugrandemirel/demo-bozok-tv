<?php

namespace App\Http\Controllers\Api\V2\Newsletters;

use App\Helpers\Response\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Service\Api\V2\Newsletters\NewsletterOutStandingService;
use Illuminate\Http\Request;

class NewsletterOutstandingController extends Controller
{
    private NewsletterOutStandingService $newsletter_outstrandings_service;

    public function __construct(NewsletterOutStandingService $newsletter_outstrandings_service)
    {
        $this->newsletter_outstrandings_service = $newsletter_outstrandings_service;
    }

    public function index()
    {
        $newsletter_outstrandings = $this->newsletter_outstrandings_service->getNewsletterOutstandings();
        return ResponseHelper::success("Öne çıkan haberler başarılı bir şekilde çekildi.", ["data" => $newsletter_outstrandings], 200);
    }
}

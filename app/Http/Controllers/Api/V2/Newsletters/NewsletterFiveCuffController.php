<?php

namespace App\Http\Controllers\Api\V2\Newsletters;

use App\Helpers\Response\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Service\Api\V2\Newsletters\NewsletterFiveCuffService;
use Illuminate\Http\Request;

class NewsletterFiveCuffController extends Controller
{
    private NewsletterFiveCuffService $newsletter_five_cuff_service;

    public function __construct(NewsletterFiveCuffService $newsletter_five_cuff_service)
    {
        $this->newsletter_five_cuff_service = $newsletter_five_cuff_service;
    }

    public function index()
    {
        $newsletter_five_cuffs = $this->newsletter_five_cuff_service->getFiveCuffs();

        return ResponseHelper::success("Haberler Başarılı bir şekilde çekildi", ["data" => $newsletter_five_cuffs], 200);
    }
}

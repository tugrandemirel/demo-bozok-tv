<?php

namespace App\Http\Controllers\Admin\Newsletter;

use App\Http\Controllers\Controller;
use App\Service\Newsletter\NewsletterFiveCuffService;
use Illuminate\Http\Request;

class NewsletterFiveCuffController extends Controller
{
    private const PATH = 'admin.newsletter.five_cuffs.';
    private NewsletterFiveCuffService $newsletter_five_cuff_service;

    public function __construct(NewsletterFiveCuffService $newsletter_five_cuff_service)
    {
        $this->newsletter_five_cuff_service = $newsletter_five_cuff_service;
    }

    public function index(Request $request)
    {
        try {
            if ($request->ajax()) {
                return $this->newsletter_five_cuff_service->getFiveCuffsForDatatable($request);
            }
            return view(self::PATH . "index");
        } catch (\Exception $exception) {
            abort(404);
        }
    }
}

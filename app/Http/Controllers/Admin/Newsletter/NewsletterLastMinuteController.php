<?php

namespace App\Http\Controllers\Admin\Newsletter;

use App\Http\Controllers\Controller;
use App\Service\Newsletter\NewsletterLastMinutesService;
use Illuminate\Http\Request;

class NewsletterLastMinuteController extends Controller
{
    private const PATH = 'admin.newsletter.last_minutes.';
    private NewsletterLastMinutesService $newsletter_last_minutes_service;

    public function __construct(NewsletterLastMinutesService $newsletter_last_minutes_service)
    {
        $this->newsletter_last_minutes_service = $newsletter_last_minutes_service;
    }

    public function index(Request $request)
    {
        try {
            if ($request->ajax()) {
                return $this->newsletter_last_minutes_service->getLastMinuteForDatatable($request);
            }
            return view(self::PATH . 'index');
        } catch (\Exception $exception) {
            abort(404);
        }
    }
}

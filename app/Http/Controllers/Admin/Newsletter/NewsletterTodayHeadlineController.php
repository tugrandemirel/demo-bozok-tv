<?php

namespace App\Http\Controllers\Admin\Newsletter;

use App\Http\Controllers\Controller;
use App\Service\Newsletter\NewsletterTodayHeadlinesService;
use Illuminate\Http\Request;

class NewsletterTodayHeadlineController extends Controller
{
    private const PATH = 'admin.newsletter.today_headlines.';
    private NewsletterTodayHeadlinesService $today_headlines_service;
    public function __construct(NewsletterTodayHeadlinesService $today_headlines_service)
    {
        $this->today_headlines_service = $today_headlines_service;
    }

    public function index(Request $request)
    {
        try {
            if ($request->ajax()) {
                return $this->today_headlines_service->getTodayHeadlineForDatatable($request);
            }
            return view(self::PATH . "index");
        } catch (\Exception $exception) {
            abort(404);
        }
    }
}

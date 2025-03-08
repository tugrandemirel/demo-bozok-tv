<?php

namespace App\Http\Controllers\Admin\Newsletter;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Newsletter\NewsletterFilterRequest;
use App\Models\Newsletter;
use App\Models\NewsletterOutstanding;
use App\Service\Newsletter\NewsletterOutstandingsService;
use Illuminate\Http\Request;

class NewsletterOutstandingController extends Controller
{
    private const PATH = 'admin.newsletter.outstandings.';

    private NewsletterOutstandingsService $newsletter_outstanding_service;

    public function __construct(NewsletterOutstandingsService $newsletter_outstanding_service)
    {
        $this->newsletter_outstanding_service = $newsletter_outstanding_service;
    }

    public function index(NewsletterFilterRequest $request)
    {
        try {
            if ($request->ajax()) {
                return $this->newsletter_outstanding_service->getOutstandingForDatatable($request);
            }
            return view(self::PATH . 'index');
        } catch (\Exception $exception) {
            abort(404);
        }
    }

//    public function sort(Request $request)
//    {
//        try {
//            $orderData = $request->input('order');  // sıralama verilerini al
//            foreach ($orderData as $item) {
//                // Her öğe için sıralama değerini güncelle
//                NewsletterOutstanding::query()
//                    ->where('id', $item['id'])
//                    ->update(['order' => $item['order']]);
//            }
//            return response()->json(['status' => 'success']);
//        } catch (\Exception $exception) {
//            dd($exception->getMessage());
//            abort(404);
//        }
//    }
}

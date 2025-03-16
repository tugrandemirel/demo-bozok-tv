<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Newsletter;
use App\Models\NewsletterPublicationStatus;

class NewsletterController extends Controller
{
    public function show($category_slug, $newsletter_slug)
    {
        try {
            $category = Category::query()
                ->where('slug', $category_slug)->first();

            $newsletter_publication_on_the_air = NewsletterPublicationStatus::onTheAir();

            $newsletter = Newsletter::query()
                ->where("slug", $newsletter_slug)
                ->with([
                    "image",
                    "seoSetting",
                    "source",
                    "createdByUser",
                ])
                ->whereRelation("status", "code", "=", $newsletter_publication_on_the_air?->code)
                ->first();

//            $newsletter->created_at = Carbon::parse($newsletter->created_at)->format('d.m.Y - H:i');
//            $newsletter->updated_at = Carbon::parse($newsletter->updated_at)->format('d.m.Y - H:i');

            return view("front.newsletter.show", compact("category", "newsletter"));
        } catch (\Exception $exception) {
            abort(404);
        }
    }
}

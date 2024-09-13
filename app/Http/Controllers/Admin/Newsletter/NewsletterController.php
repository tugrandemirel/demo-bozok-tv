<?php

namespace App\Http\Controllers\Admin\Newsletter;

use App\Enum\Category\CategoryIsActiveEnum;
use App\Enum\NewsletterSource\NewsletterSourceIsActiveEnum;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\NewsletterPublicationStatus;
use App\Models\NewsletterSource;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    private const PATH = 'admin.newsletter.';

    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view(self::PATH.'index');
    }

    public function create()
    {
        /** @var Category $categories */
        $categories = Category::query()
            ->select('uuid', 'name')
            ->where('is_active', CategoryIsActiveEnum::ACTIVE)
            ->orderBy('order')
            ->get();

        /** @var NewsletterPublicationStatus $publication_status */
        $publication_statuses = NewsletterPublicationStatus::query()
            ->select('uuid', 'name')
            ->get();

        /** @var NewsletterSource $newsletter_sources */
        $newsletter_sources = NewsletterSource::query()
            ->select('uuid', 'name')
            ->where('is_active', NewsletterSourceIsActiveEnum::ACTIVE)
            ->orderBy('order')
            ->get();

        return view('admin.newsletter.create.create', compact('categories', 'publication_statuses', 'newsletter_sources'));
    }
}

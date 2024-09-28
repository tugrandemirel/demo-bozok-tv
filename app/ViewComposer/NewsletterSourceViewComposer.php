<?php

namespace App\ViewComposer;

use App\Enum\NewsletterSource\NewsletterSourceIsActiveEnum;
use App\Models\NewsletterSource;
use Illuminate\View\View;

class NewsletterSourceViewComposer
{
    public function compose(View $view): void
    {

        /** @var NewsletterSource $newsletter_sources */
        $newsletter_sources = NewsletterSource::query()
            ->select('uuid', 'name', 'id')
            ->where('is_active', NewsletterSourceIsActiveEnum::ACTIVE)
            ->orderBy('order')
            ->get();

        $view->with('newsletter_sources', $newsletter_sources);
    }
}

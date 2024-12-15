<?php

namespace App\Providers;

use App\Models\AdType;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class AdTypeViewComposer
{
    public function compose(View $view): void
    {
        $ad_types = Cache::rememberForever('ad_types', function () {
            return AdType::query()
                ->get();
        });

        $view->with('ad_types', $ad_types);
    }
}

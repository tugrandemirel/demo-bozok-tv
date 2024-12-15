<?php

namespace App\ViewComposer;

use App\Models\Placement;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class PlacementViewComposer
{
    public function compose(View $view): void
    {
        /** @var Placement $placements */
        $placements = Cache::rememberForever('placements', function () {
            return Placement::query()
                ->get();
        });

        $view->with('placements', $placements);
    }
}

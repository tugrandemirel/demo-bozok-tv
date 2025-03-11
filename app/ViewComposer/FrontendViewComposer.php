<?php

namespace App\ViewComposer;

use App\Enum\Category\CategoryHomePageEnum;
use App\Enum\Category\CategoryIsActiveEnum;
use App\Models\Category;
use App\Settings\GeneralSetting;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class FrontendViewComposer
{
    public function compose(View $view): void
    {
        $home_categories = Cache::rememberForever('home_categories',  function () {
            return Category::query()
                ->select('uuid', 'name', 'slug')
                ->where('is_active', CategoryIsActiveEnum::ACTIVE)
                ->where('home_page', CategoryHomePageEnum::ACTIVE)
                ->orderBy('order')
                ->get();
        });
        $view->with('home_categories', $home_categories);

        $general_setting = Cache::rememberForever('general_setting_home',  function () {
            return new GeneralSetting();
        });
        $view->with('general_setting', $general_setting);
    }
}

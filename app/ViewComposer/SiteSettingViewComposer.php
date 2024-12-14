<?php

namespace App\ViewComposer;

use App\Settings\GeneralSetting;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class SiteSettingViewComposer
{
    public function compose(View $view): void
    {
       $general_setting = Cache::rememberForever('generel_setting',  function () {
           return new GeneralSetting();
       });

       $view->with('general_setting', $general_setting);
    }
}

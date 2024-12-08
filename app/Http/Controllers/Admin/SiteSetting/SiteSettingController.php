<?php

namespace App\Http\Controllers\Admin\SiteSetting;

use App\Http\Controllers\Controller;
use App\Settings\ContactSetting;
use App\Settings\GeneralSetting;

class SiteSettingController extends Controller
{
    const PATH = 'admin.site-setting.';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $general_setting = app(GeneralSetting::class);
        $contact_setting = app(ContactSetting::class);

        return view(self::PATH.'index', compact('general_setting', 'contact_setting'));
    }
}

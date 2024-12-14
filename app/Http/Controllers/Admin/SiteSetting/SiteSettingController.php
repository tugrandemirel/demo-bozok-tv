<?php

namespace App\Http\Controllers\Admin\SiteSetting;

use App\Http\Controllers\Controller;
use App\Settings\ContactSetting;
use App\Settings\GeneralSetting;
use App\Settings\SeoSetting;
use App\Settings\SocialMediaSetting;

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
        // TODO: SeoSetting alanı düzenlenecek.
        $seo_setting = app(SeoSetting::class);
        $social_medias = app(SocialMediaSetting::class);

        return view(self::PATH.'index', compact('general_setting', 'contact_setting', 'seo_setting', 'social_medias'));
    }
}

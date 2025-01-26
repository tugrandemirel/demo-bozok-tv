<?php

namespace App\Repositories;

use App\Interfaces\Repositories\SiteSettingRepositoryInterface;
use App\Settings\ContactSetting;
use App\Settings\GeneralSetting;
use App\Settings\SocialMediaSetting;

class SiteSettingRepository implements SiteSettingRepositoryInterface
{
    public function getGeneralSetting()
    {
        $general_setting = app(GeneralSetting::class);

        return $general_setting;
    }

    public function getContactSetting()
    {
        $contact_setting = app(ContactSetting::class);
        return $contact_setting;
    }

    public function getSocialMediaSetting()
    {
        $social_media_setting = app(SocialMediaSetting::class);
        return $social_media_setting;
    }
}

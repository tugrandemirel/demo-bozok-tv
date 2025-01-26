<?php

namespace App\Service\Setting;

use App\Repositories\SiteSettingRepository;

class SiteSettingService
{
    private SiteSettingRepository $setting_repository;
    public function __construct(SiteSettingRepository $setting_repository)
    {
        $this->setting_repository = $setting_repository;
    }

    public function getGeneralSetting()
    {
        $general_setting = $this->setting_repository->getGeneralSetting();
        return $general_setting;
    }

    public function getContactSetting()
    {
        $general_setting = $this->setting_repository->getContactSetting();
        return $general_setting;
    }

    public function getSocialMediaSetting()
    {
        $general_setting = $this->setting_repository->getSocialMediaSetting();
        return $general_setting;
    }
}

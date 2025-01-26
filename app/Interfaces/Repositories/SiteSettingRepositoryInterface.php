<?php

namespace App\Interfaces\Repositories;

interface SiteSettingRepositoryInterface
{
    public function getGeneralSetting();
    public function getContactSetting();
    public function getSocialMediaSetting();
}

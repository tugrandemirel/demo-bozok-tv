<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class GeneralSetting extends Settings
{
    public string $site_name;
    public string $slogan;
    public ?array $logo;
    public ?array $favicon;
    public string $url;
    public bool $is_active;
    public static function group(): string
    {
        return 'general_setting';
    }

    public function getLogoImage()
    {
        return !is_null($this->logo) ? asset($this->logo['path']) : "https://ui-avatars.com/api/?name=$this->site_name&background=random&color=fff";
    }
}

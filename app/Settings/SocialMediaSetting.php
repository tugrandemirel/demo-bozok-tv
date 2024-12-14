<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class SocialMediaSetting extends Settings
{
    public ?array $links = [];

    public static function group(): string
    {
        return 'social_media_setting';
    }
}

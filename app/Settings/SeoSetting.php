<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class SeoSetting extends Settings
{

    public static function group(): string
    {
        return 'seo';
    }
}

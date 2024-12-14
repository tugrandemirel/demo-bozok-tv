<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class SeoSetting extends Settings
{
    public ?string $default_title = 'Varsayılan Başlık';
    public ?string $default_description = 'Varsayılan Açıklama';
    public ?array $default_keywords = ['varsayılan', 'anahtar', 'kelimeler'];
    public array $pages = [
        'about' => [
            'title' => 'Hakkımızda',
            'description' => 'Hakkımızda açıklama.',
            'keywords' => ['hakkımızda', 'site', 'bilgi'],
        ],
        'contact' => [
            'title' => 'İletişim',
            'description' => 'Bize ulaşın.',
            'keywords' => ['iletişim', 'destek'],
        ],
    ];
    public static function group(): string
    {
        return 'seo';
    }
}

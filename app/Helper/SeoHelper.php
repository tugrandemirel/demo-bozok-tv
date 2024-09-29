<?php

namespace App\Helper;

use App\Models\seo_setting;
use App\Models\SeoSetting;

class SeoHelper
{
    protected $seo_setting;

    public function __construct(SeoSetting $seo_setting)
    {
        $this->seo_setting = $seo_setting;
    }

    public function renderMetaTags(): string
    {
        return '
            <title>' . htmlspecialchars($this->seo_setting->meta_title) . '</title>
            <meta name="description" content="' . htmlspecialchars($this->seo_setting->meta_description) . '">
            <meta name="keywords" content="' . htmlspecialchars($this->seo_setting->meta_keywords) . '">
            <link rel="canonical" href="' . htmlspecialchars($this->seo_setting->canonical_url) . '">
            <meta property="og:title" content="' . htmlspecialchars($this->seo_setting->og_title) . '">
            <meta property="og:description" content="' . htmlspecialchars($this->seo_setting->og_description) . '">
            <meta property="og:image" content="' . htmlspecialchars($this->seo_setting->og_image) . '">
            <meta property="og:url" content="' . htmlspecialchars($this->seo_setting->canonical_url) . '">
            <meta property="og:type" content="website">
            <meta name="twitter:card" content="summary_large_image">
            <meta name="twitter:title" content="' . htmlspecialchars($this->seo_setting->twitter_title) . '">
            <meta name="twitter:description" content="' . htmlspecialchars($this->seo_setting->twitter_description) . '">
            <meta name="twitter:image" content="' . htmlspecialchars($this->seo_setting->twitter_image) . '">
        ';
    }
}

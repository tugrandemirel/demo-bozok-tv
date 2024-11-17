<?php

namespace App\Helpers\Custom;

use App\Enum\Gallery\GalleryTypeEnum;
use App\Enum\MorphImage\MorphImageImageTypeEnum;

class CustomHelper
{
    public static function getIdByUuid($modelClass, $uuid)
    {
        if (!class_exists($modelClass) || !$uuid) {
            return null;
        }

        // Modeli dinamik olarak başlat ve uuid ile sorgula
        $model = new $modelClass;
        $record = $model->where('uuid', $uuid)->first();

        return $record ? $record->id : null;
    }

    public static function getNewsletterPublicationStatusLabelColor($status)
    {
        $colors = [
            'archive' => 'info',
            'on-the-air' => 'success',
            'draft' => 'warning',
            'removed' => 'danger',
        ];

        return $colors[$status];
    }

    public static function getPostStatusLabelColor($status)
    {
        $colors = [
            'pending' => 'info',
            'approved' => 'success',
            'rejected' => 'danger',
        ];

        return $colors[$status];
    }

    public static function getNewsletterPublicationStatusLabelText($status)
    {
        $colors = [
            'archive' => 'Arşiv',
            'on-the-air' => 'Yayında',
            'draft' => 'Taslak',
            'removed' => 'Yayından Kaldırılmış',
        ];

        return $colors[$status];
    }

    public static function getImageTypeName(MorphImageImageTypeEnum $type)
    {
        return match ($type) {
            MorphImageImageTypeEnum::COVER => 'KAPAK',
            MorphImageImageTypeEnum::INSIDE => 'İÇ KAPAK',
            MorphImageImageTypeEnum::FEATURED => 'BEŞLİ MANŞET',
            default => 'Bilinmeyen Tür',
        };
    }

    public static function getGalleryTypeName(GalleryTypeEnum $enum)
    {
        return match ($enum) {
            GalleryTypeEnum::IMAGE => 'Resim Galeri',
            GalleryTypeEnum::VIDEO => 'Video Galeri',

        };
    }


    public static function getEmbed($url)
    {
        $embed = '';
        if ($url) {
            $embed = explode('?v=', $url)[1];
            if (!$embed) {
                return '';
            }
        }
        return $embed;
    }
}

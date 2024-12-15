<?php

namespace App\Helpers\Custom;

use App\Enum\Gallery\GalleryTypeEnum;
use App\Enum\MorphImage\MorphImageImageTypeEnum;
use App\Enum\Survey\SurveyStatusEnum;

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
    public static function getIdByCode($modelClass, $code)
    {
        if (!class_exists($modelClass) || !$code) {
            return null;
        }

        $model = new $modelClass;
        $record = $model->where('code', $code)->first();

        return $record ? $record->id : null;
    }

    public static function getNewsletterPublicationStatusLabelColor($status): string
    {
        $colors = [
            'archive' => 'info',
            'on-the-air' => 'success',
            'draft' => 'warning',
            'removed' => 'danger',
        ];

        return $colors[$status] ?? '-';
    }

    public static function getPostStatusLabelColor($status): string
    {
        $colors = [
            'pending' => 'info',
            'approved' => 'success',
            'rejected' => 'danger',
        ];

        return $colors[$status] ?? '-';
    }

    public static function getNewsletterPublicationStatusLabelText($status): string
    {
        $colors = [
            'archive' => 'Arşiv',
            'on-the-air' => 'Yayında',
            'draft' => 'Taslak',
            'removed' => 'Yayından Kaldırılmış',
        ];

        return $colors[$status] ?? '-';
    }

    public static function getSurveyStatusColor($status)
    {
        return match ($status) {
            SurveyStatusEnum::ACTIVE => 'success',
            SurveyStatusEnum::INACTIVE => 'danger',
            default => 'info'
        };
    }

    public static function getSurveyStatusText($status)
    {
        return match ($status) {
            SurveyStatusEnum::ACTIVE => 'Yayında',
            SurveyStatusEnum::INACTIVE => 'Yayında Değil',
            default => 'info'
        };
    }

    public static function getImageTypeName(MorphImageImageTypeEnum $type): string
    {
        return match ($type) {
            MorphImageImageTypeEnum::COVER => 'KAPAK',
            MorphImageImageTypeEnum::INSIDE => 'İÇ KAPAK',
            MorphImageImageTypeEnum::FEATURED => 'BEŞLİ MANŞET',
            default => 'Bilinmeyen Tür',
        };
    }

    public static function getGalleryTypeName(GalleryTypeEnum $enum): string
    {
        return match ($enum) {
            GalleryTypeEnum::IMAGE => 'Resim Galeri',
            GalleryTypeEnum::VIDEO => 'Video Galeri',

        };
    }


    public static function getEmbed($url): string
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

    /**
     * @param $url
     * @return array|string|string[]|null
     */
    public static function formatUrl($url): array|string|null
    {
        // URL'yi küçük harflere dönüştür
        $url = strtolower(trim($url));

        // Eğer URL 'http' veya 'https' ile başlamıyorsa, 'https' ekle
        if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
            $url = 'https://' . $url;
        }

        // www'yı kaldır
        $url = preg_replace('/^https?:\/\/(www\.)/', 'https://', $url);

        // URL'yi düzgün formatta döndür
        return $url;
    }
}

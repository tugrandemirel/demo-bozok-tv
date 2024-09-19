<?php

namespace App\Helpers\Custom;

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
}

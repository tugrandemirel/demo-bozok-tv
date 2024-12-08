<?php

namespace App\Http\Controllers\Admin\SiteSetting;

use App\Helper\ImageHelper;
use App\Helpers\Response\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SiteSetting\GeneralSettingRequest;
use App\Settings\GeneralSetting;
use Illuminate\Http\JsonResponse;

class GeneralSettingController extends Controller
{
    public function store(GeneralSettingRequest $request): JsonResponse
    {
        $attributes = collect($request->validated());

        try {
            $general_setting = new GeneralSetting();

            if ($request->logo) {
                $logo = ImageHelper::updateImage($attributes->get('logo'), $general_setting->logo['path'] ?? null);

                $general_setting->logo = [
                    'image_name' => $logo['image_name'],
                    'image_ext' => $logo['image_ext'],
                    'size' => $logo['size'],
                    'path' => $logo['path'],
                    'alt_text' => $logo['alt_text'],
                    'width' => $logo['width'],
                    'height' => $logo['height'],
                    'mime_type' => $logo['mime_type'],
                ];
            }

            if ($request->favicon) {
                $favicon = ImageHelper::updateImage($attributes->get('favicon'), $general_setting->favicon['path'] ?? null);

                $general_setting->favicon = [
                    'image_name' => $favicon['image_name'],
                    'image_ext' => $favicon['image_ext'],
                    'size' => $favicon['size'],
                    'path' => $favicon['path'],
                    'alt_text' => $favicon['alt_text'],
                    'width' => $favicon['width'],
                    'height' => $favicon['height'],
                    'mime_type' => $favicon['mime_type'],
                ];
            }

            $general_setting->site_name = $attributes->get('site_name');
            $general_setting->url = $attributes->get('url');
            $general_setting->is_active = $attributes->get('is_active');

            $general_setting->save();

            return ResponseHelper::success('İşleminiz başarılı bir şekilde gerçekleştirildi');
        } catch (\Exception $exception) {dd($exception->getMessage());
            return ResponseHelper::error('Bir hata oluştu.', [$exception->getMessage()]);
        }
    }
}

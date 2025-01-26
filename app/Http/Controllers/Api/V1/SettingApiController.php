<?php

namespace App\Http\Controllers\Api\V1;

use App\Helpers\Response\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Service\Setting\SiteSettingService;
use Illuminate\Http\JsonResponse;

class SettingApiController extends Controller
{
    private SiteSettingService $site_setting_service;

    public function __construct(SiteSettingService $site_setting_service)
    {
        $this->site_setting_service = $site_setting_service;
    }

    public function generalSetting(): JsonResponse
    {
        try {
            $general_setting = $this->site_setting_service->getGeneralSetting();
            return ResponseHelper::success("işlem başarılı bir şekilde gerçekleştirildi.", ["data" => $general_setting]);
        } catch (\Exception $exception) {
            return ResponseHelper::error("Bir hata ile karşılaşıldı.", $exception->getMessage());
        }
    }

    public function contactSetting(): JsonResponse
    {
        try {
            $contact_setting = $this->site_setting_service->getContactSetting();
            return ResponseHelper::success("işlem başarılı bir şekilde gerçekleştirildi.", ["data" => $contact_setting]);
        } catch (\Exception $exception) {
            return ResponseHelper::error("Bir hata ile karşılaşıldı.", $exception->getMessage());
        }
    }

    public function socialMediaSetting(): JsonResponse
    {
        try {
            $social_media_setting = $this->site_setting_service->getSocialMediaSetting();
            return ResponseHelper::success("işlem başarılı bir şekilde gerçekleştirildi.", ["data" => $social_media_setting]);
        } catch (\Exception $exception) {
            return ResponseHelper::error("Bir hata ile karşılaşıldı.", $exception->getMessage());
        }
    }
}

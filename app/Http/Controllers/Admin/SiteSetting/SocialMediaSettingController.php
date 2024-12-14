<?php

namespace App\Http\Controllers\Admin\SiteSetting;

use App\Helpers\Response\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SiteSetting\SocialMediaSettingRequest;
use App\Settings\SocialMediaSetting;
use Illuminate\Http\Request;

class SocialMediaSettingController extends Controller
{
    public function store(SocialMediaSettingRequest $request)
    {
        $attributes = collect($request->validated());

        try {

            $socialMediaLinks = [];
            foreach ($attributes->get('links') as $link) {
                $socialMediaLinks[] = [
                    'name' => $link['name'] ?? '',
                    'icon' => $link['icon'] ?? '',
                    'url' => $link['url'] ?? '',
                    'is_active' => isset($link['is_active']) ? (bool) $link['is_active'] : false,
                ];
            }

            /** @var SocialMediaSetting $social_media */
            $social_media = new SocialMediaSetting();
            $social_media->links = $socialMediaLinks;
            $social_media->save();

            return ResponseHelper::success('İşleminiz başarılı bir şekilde gerçekleştirildi');
        } catch (\Exception $exception) {
            dd($exception->getMessage());
            return ResponseHelper::error('Bir hata oluştu.', [$exception->getMessage()]);
        }
    }
}

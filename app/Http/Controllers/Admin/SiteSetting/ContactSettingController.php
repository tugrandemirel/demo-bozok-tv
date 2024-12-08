<?php

namespace App\Http\Controllers\Admin\SiteSetting;

use App\Helpers\Response\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SiteSetting\ContactSettingRequest;
use App\Settings\ContactSetting;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ContactSettingController extends Controller
{
    public function store(ContactSettingRequest $request): JsonResponse
    {
        $attributes = collect($request->validated());

        try {
            $contact_setting = new  ContactSetting();
            $contact_setting->phone = $attributes->get('phone');
            $contact_setting->email = $attributes->get('email');
            $contact_setting->address = $attributes->get('address');
            $contact_setting->save();

            return ResponseHelper::success('İşleminiz başarılı bir şekilde gerçekleştirildi');
        } catch (\Exception $exception) {dd($exception->getMessage());
            return ResponseHelper::error('Bir hata oluştu.', [$exception->getMessage()]);
        }
    }
}

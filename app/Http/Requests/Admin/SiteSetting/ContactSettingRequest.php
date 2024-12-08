<?php

namespace App\Http\Requests\Admin\SiteSetting;

use App\Helpers\Custom\CustomHelper;
use App\Helpers\Response\ResponseHelper;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ContactSettingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(ResponseHelper::validationError($validator->errors()));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "phone" => "nullable|string|max:190",
            "email" => "nullable|string|max:190",
            "address" => "nullable|string|max:190",
        ];
    }

    public function attributes(): array
    {
        return [
            "phone" => "İletişim Numarası",
            "email" => "E-Posta Adresi",
            "address" => "Adres",
        ];
    }
}

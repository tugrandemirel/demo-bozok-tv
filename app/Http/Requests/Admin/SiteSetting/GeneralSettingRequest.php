<?php

namespace App\Http\Requests\Admin\SiteSetting;

use App\Helpers\Custom\CustomHelper;
use App\Helpers\Response\ResponseHelper;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use JetBrains\PhpStorm\NoReturn;

class GeneralSettingRequest extends FormRequest
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
            "site_name" => "required|string|max:190",
            "favicon" => "nullable|mimes:jpg,jpeg,png,ico,gif",
            "logo" => "nullable|mimes:jpg,jpeg,png",
            "slogan" => "required|string|max:190",
            "url" => "required|string|url|max:191",
            "is_active" => "required|bool"
        ];
    }

    public function attributes(): array
    {
        return [
            "site_name" => "Site Adı",
            "favicon" => "Favicon",
            "logo" => "Logo",
            "is_active" => "Site Aktifliği",
            "url" => "Site URL"
        ];
    }

    protected function prepareForValidation(): void
    {
        $url = CustomHelper::formatUrl($this->get('url'));
        $this->merge([
            'url' => $url,
            "is_active" => $this->get('is_active') === "on"
        ]);
    }
}

<?php

namespace App\Http\Requests\Admin\SiteSetting;

use App\Helpers\Response\ResponseHelper;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class SocialMediaSettingRequest extends FormRequest
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
            "links" => "nullable|array",
            "links.*.name" => "required|string|max:191",
            "links.*.icon" => "required|string|max:191",
            "links.*.url" => "required|string|max:191",
            "links.*.is_active" => "nullable",
        ];
    }

    public function messages(): array
    {
        $messages = [];

        // "links" dizisindeki her bir öğe için mesajları özelleştir
        foreach ($this->input('links', []) as $index => $link) {
            $messages["links.{$index}.name.required"] = ($index + 1)." Satırdaki Sosyal Medya Adı zorunludur.";
            $messages["links.{$index}.icon.required"] = ($index + 1)." Satırdaki Sosyal Medya Icon zorunludur.";
            $messages["links.{$index}.url.required"] = ($index + 1)." Satırdaki Sosyal Medya URL zorunludur.";
            $messages["links.{$index}.name.max"] = ($index + 1)." Satırdaki Sosyal Medya Adı uzunluğu en fazla 191 karakter olmalıdır.";
            $messages["links.{$index}.icon.max"] = ($index + 1)." Satırdaki Sosyal Medya Icon uzunluğu en fazla 191 karakter olmalıdır.";
            $messages["links.{$index}.url.max"] = ($index + 1)." Satırdaki Sosyal Medya URL uzunluğu en fazla 191 karakter olmalıdır.";
        }

        return $messages;
    }

}

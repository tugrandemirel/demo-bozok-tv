<?php

namespace App\Http\Requests\Admin\Gallery;

use App\Enum\Gallery\GalleryIsActiveEnum;
use App\Enum\Gallery\GalleryTypeEnum;
use App\Helpers\Custom\CustomHelper;
use App\Helpers\Response\ResponseHelper;
use App\Models\Gallery;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rules\Enum;

class GalleryStoreRequest extends FormRequest
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
            'title' => 'required',
            'description' => 'required',
            'file' => 'required|mimes:jpg,jpeg,png',
            'type' => ['required', new Enum(GalleryTypeEnum::class)],
            'is_active' => ['required', new Enum(GalleryIsActiveEnum::class)]
        ];
    }

    public function attributes(): array
    {
        return [
            'title' => 'Galeri Başlığı',
            'description' => 'Galeri Açıklaması',
            'file' => 'Galeri Görseli',
            'type' => 'Galeri Türü',
            'is_active' => 'Galeri Aktifliği',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_active' => $this->input('is_active') === 'on' ? GalleryIsActiveEnum::ACTIVE->value : GalleryIsActiveEnum::INACTIVE->value
        ]);
    }
}

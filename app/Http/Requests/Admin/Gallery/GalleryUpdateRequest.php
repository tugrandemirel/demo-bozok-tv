<?php

namespace App\Http\Requests\Admin\Gallery;

use App\Enum\Gallery\GalleryIsActiveEnum;
use App\Enum\Gallery\GalleryTypeEnum;
use App\Helpers\Response\ResponseHelper;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rules\Enum;

class GalleryUpdateRequest extends FormRequest
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
            'file_update' => 'nullable|mimes:jpg,jpeg,png',
            'type' => ['required', new Enum(GalleryTypeEnum::class)],
            'is_active' => ['required', new Enum(GalleryIsActiveEnum::class)],
            'gallery_uuid' => 'required|exists:galleries,uuid'
        ];
    }

    public function attributes(): array
    {
        return [
            'title' => 'Galeri Başlığı',
            'description' => 'Galeri Açıklaması',
            'file_update' => 'Galeri Görseli',
            'type' => 'Galeri Türü',
            'is_active' => 'Galeri Aktifliği',
            "gallery_uuid" => "Galeri benzersiz kimliği"
        ];
    }

    public function messages(): array
    {
        return [
            'gallery_uuid' => 'Galeri benzersiz kimliği gereklidir.'
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_active' => $this->input('is_active') === 'on' ? GalleryIsActiveEnum::ACTIVE->value : GalleryIsActiveEnum::INACTIVE->value
        ]);
    }
}

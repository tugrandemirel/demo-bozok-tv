<?php

namespace App\Http\Requests\Admin\Gallery\GalleryImage;

use App\Enum\Gallery\GalleryImage\GalleryImageEnum;
use App\Helpers\Response\ResponseHelper;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rules\Enum;

class GalleryImageStoreRequest extends FormRequest
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
            'gallery_uuid' => 'required',
            'alt_text' => 'required|string|max:191',
            'file' => 'required|mimes:jpg,jpeg,png',
            'is_active' => ['required', new Enum(GalleryImageEnum::class)]
        ];
    }

    public function attributes(): array
    {
        return [
            'gallery_uuid' => "Galeri benzersiz kimliği",
            "alt_text" => "Resim Alt Açıklama",
            "file" => "Resim",
            "is_active" => "Resim Aktifliği"
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_active' => $this->input('is_active') === 'on' ? GalleryImageEnum::ACTIVE->value : GalleryImageEnum::INACTIVE->value
        ]);
    }
}

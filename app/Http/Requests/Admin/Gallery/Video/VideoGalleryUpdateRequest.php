<?php

namespace App\Http\Requests\Admin\Gallery\Video;

use App\Enum\Gallery\VideoGallery\VideoGalleryIsActiveEnum;
use App\Helpers\Response\ResponseHelper;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rules\Enum;

class VideoGalleryUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
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
            'video_url' => 'required:url',
            'uuid' => 'required',
            'caption' => 'required|max:191',
            'is_active' => ['required', new Enum(VideoGalleryIsActiveEnum::class)]
        ];
    }

    public function attributes(): array
    {
        return [
            'video_url' => 'Video Url',
            'uuid' => 'Video Galeri Benzersiz Kimliği',
            'caption' => 'Açıklama',
            'is_active' => 'Aktiflik',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_active' => $this->input('is_active') === 'on' ? VideoGalleryIsActiveEnum::ACTIVE->value : VideoGalleryIsActiveEnum::INACTIVE->value
        ]);
    }
}

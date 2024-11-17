<?php

namespace App\Http\Requests\Admin\Posts;

use App\Helpers\Response\ResponseHelper;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class PostUpdateRequest extends FormRequest
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
            "post_uuid" => "required|exists:posts,uuid",
            "post_status_code" => "required|exists:post_statuses,code",
            "review_note" => "nullable|string|max:350",
        ];
    }

    public function attributes(): array
    {
        return [
            "post_uuid" => "Köşe Yazısı kimliği",
            "post_status_code" => "Köşe Yazısı durum",
            "review_note" => "Geri bildirim mesajı",
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            "post_status_code" => $this->get('post_status')
        ]);
    }
}

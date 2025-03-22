<?php

namespace App\Http\Requests\Front\Comment;

use App\Helpers\Response\ResponseHelper;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CommentStoreRequest extends FormRequest
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
            "user_name" => "required|string|max:190",
            "content" => "required|string|max:500",
            "newsletter_uuid" => "required|exists:newsletters,uuid",
        ];
    }

    protected function passedValidation()
    {
        $this->merge([
            'user_name' => strip_tags($this->input('user_name')), // HTML etiketlerini temizle
            'content' => strip_tags($this->input('content')), // XSS koruması
        ]);
    }
}

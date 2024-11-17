<?php

namespace App\Http\Requests\Author\Posts;

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
            'title' => "required|max:160|string",
            "file" => "nullable|mimes:jpg,jpeg,png",
            "content" => "required|string",
            "post_uuid" => "required|exists:posts,uuid"
        ];
    }
    public function attributes()
    {
        return [
            "post_uuid" => "Köşe Yazısı benzersiz kimliği",
            "title" => "Başlık",
            "file" => "Kapak Görseli",
            "content" => "Köşe yazısı içeriği",
        ];
    }
}

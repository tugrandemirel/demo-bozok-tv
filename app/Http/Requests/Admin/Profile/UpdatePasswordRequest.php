<?php

namespace App\Http\Requests\Admin\Profile;

use App\Helpers\Response\ResponseHelper;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Hash;
use phpDocumentor\Reflection\Types\This;

class UpdatePasswordRequest extends FormRequest
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

    public function rules(): array
    {
        return [
            'current_password' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (!Hash::check($value, auth()->user()->password)) {
                        $fail('Mevcut şifreniz doğru değil.');
                    }
                },
            ],
            'new_password' => [
                'required',
                'string',
                'min:8',  // Yeni şifre en az 8 karakter olmalı
                'confirmed', // Yeni şifre ile şifre tekrarının eşleşmesi zorunlu
                'different:current_password', // Yeni şifre mevcut şifreden farklı olmalı
            ],
        ];
    }

    public function messages()
    {
        return [
            'new_password.regex' => 'Şifreniz en az bir büyük harf, bir küçük harf, bir rakam ve bir özel karakter içermelidir. Ayrıca, en az 8 karakter uzunluğunda olmalıdır.',
        ];
    }

    public function attributes(): array
    {
        return [
            "current_password" => "Mevcut Şifre",
            "new_password" => "Yeni Şifre",
        ];
    }
}

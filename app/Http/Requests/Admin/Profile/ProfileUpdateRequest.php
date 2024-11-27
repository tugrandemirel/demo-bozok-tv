<?php

namespace App\Http\Requests\Admin\Profile;

use App\Helpers\Response\ResponseHelper;
use App\Models\User;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'regex:/^\+90\(\d{3}\) \d{3}-\d{4}$/'], // "(999) 999-9999" formatını kontrol eder
            'profile' => ['nullable', 'mimes:jpg,jpeg,png'],
            'email' => ['required', 'string', 'lowercase', 'max:255', Rule::unique(User::class)->ignore($this->user()->id),  'email:filter,dns'],
        ];
    }

    public function attributes(): array
    {
        return [
            "name" => "Adınız",
            "surname" => "Soyadınız",
            "profile" => "Profil Fotoğrafınız",
            "email" => "E-Posta"
        ];
    }

    public function messages(): array
    {
        return [
            'phone.required' => 'Telefon numarası alanı zorunludur.',
            'phone.regex' => 'Telefon numarası doğru formatta değil. Örn: +90(123) 456-7890',
        ];
    }
}

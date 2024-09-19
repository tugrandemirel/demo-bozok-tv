<?php

namespace App\Http\Requests\Admin\Newsletter\NewsletterSource;

use App\Enum\NewsletterSource\NewsletterSourceIsActiveEnum;
use App\Helpers\Response\ResponseHelper;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rules\Enum;

class NewsletterSourceStoreRequest extends FormRequest
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
            'name' => 'required|max:191|min:3',
            'url' => 'required|url|min:3|max:191|unique:newsletter_sources,url',
            'is_active' => ['required', new Enum(NewsletterSourceIsActiveEnum::class)],
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'Kaynak',
            'url' => 'URL',
            'is_active' => 'Aktiflik',
        ];
    }

    public function messages()
    {
        return [
            'url' => "Girilen URL geçersizdir. Lütfen <b>https://example.com</b> şeklinde giriniz."
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'name' => $this->get('source'),
            'is_active' => $this->get('is_active') === 'on' ? NewsletterSourceIsActiveEnum::ACTIVE->value : NewsletterSourceIsActiveEnum::PASSIVE->value,
        ]);
    }
}

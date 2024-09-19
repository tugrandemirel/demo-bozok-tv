<?php

namespace App\Http\Requests\Admin\Newsletter\Category;

use App\Enum\Category\CategoryHomePageEnum;
use App\Enum\Category\CategoryIsActiveEnum;
use App\Helpers\Response\ResponseHelper;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rules\Enum;

class CategoryStoreRequest extends FormRequest
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
            'name' => 'required|max:190|min:3',
            'home_page' => ['required', new Enum(CategoryHomePageEnum::class)],
            'is_active' => ['required', new Enum(CategoryIsActiveEnum::class)],
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Kategori Adı',
            'home_page' => 'Anasayfada Göster',
            'is_active' => 'Aktiflik',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'name' => $this->get('category'),
            'home_page' => $this->get('home_page') === 'on' ? CategoryHomePageEnum::ACTIVE->value : CategoryHomePageEnum::PASSIVE->value,
            'is_active' => $this->get('is_active') === 'on' ? CategoryIsActiveEnum::ACTIVE->value : CategoryIsActiveEnum::PASSIVE->value,
        ]);
    }
}

<?php

namespace App\Http\Requests\Admin\Surveys;

use App\Enum\Survey\SurveyStatusEnum;
use App\Helpers\Response\ResponseHelper;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rules\Enum;

class SurveyUpdateRequest extends FormRequest
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
            "title" =>  "required|max:191|string",
            "description" =>  "nullable|max:191|string",
            "start_date" => "nullable|date_format:Y-m-d H:i:s",
            "end_date" => "nullable|date_format:Y-m-d H:i:s",
            "status" => [
                "required",
                new Enum(SurveyStatusEnum::class)
            ],
            'uuid' => "required|exists:surveys,uuid"
        ];
    }

    public function attributes(): array
    {
        return [
            "title" => "Anket Başlığı",
            "description" => "Anket Açıklaması",
            "status" => "Anket Durumu",
            "start_date" => "Anket Başlangış Tarihi",
            "end_date" => "Anket Bitiş Tarihi",
            "uuid" => "Anket Kimliği"
        ];
    }

    public function prepareForValidation(): void
    {
        $this->merge([
            "status" => $this->get("status") === "on" ? SurveyStatusEnum::ACTIVE->value :  SurveyStatusEnum::INACTIVE->value
        ]);
    }
}

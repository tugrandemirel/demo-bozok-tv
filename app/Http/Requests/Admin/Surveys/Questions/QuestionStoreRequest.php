<?php

namespace App\Http\Requests\Admin\Surveys\Questions;

use App\Helpers\Response\ResponseHelper;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class QuestionStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @param Validator $validator
     * @return mixed
     */
    protected function failedValidation(Validator $validator): mixed
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
            "question_text" => "required|string|max:191",
            "answer_text" => "required|array|min:1",
            "answer_text.*" => "string|max:191",
            "survey_uuid" => "required|exists:surveys,uuid"
        ];
    }

    public function attributes(): array
    {
        return [
            "question_text" => "Soru",
            "answer_text" => "Soru Seçeneği",
            "survey_uuid" => "Anket Kimliği"
        ];
    }
}

<?php

namespace App\Http\Requests\Admin\Newsletter;

use App\Helpers\Custom\CustomHelper;
use App\Helpers\Response\ResponseHelper;
use App\Models\Newsletter;
use App\Models\NewsletterPublicationStatus;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class NewsletterPublicationStatusChangeRequest extends FormRequest
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
            'newsletter' => 'required|exists:newsletters,id',
            'newsletter_publication_status_id' => 'required|exists:newsletter_publication_statuses,id'
        ];
    }

    public function attributes(): array
    {
        return [
            'newsletter' => 'Haber Kimliği',
            'newsletter_publication_status_id' => 'Yayın Durumu'
        ];
    }

    public function prepareForValidation(): void
    {
        $this->merge([
            'newsletter' => CustomHelper::getIdByUuid(Newsletter::class, $this->get('newsletter')),
            'newsletter_publication_status_id' => CustomHelper::getIdByUuid(NewsletterPublicationStatus::class, $this->get('publication_status')),
        ]);
    }
}

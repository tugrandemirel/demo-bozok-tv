<?php

namespace App\Http\Requests\Admin\Newsletter;

use App\Enum\Newsletter\NewsletterGeneralEnum;
use App\Helpers\Custom\CustomHelper;
use App\Helpers\Response\ResponseHelper;
use App\Models\Category;
use App\Models\Newsletter;
use App\Models\NewsletterPublicationStatus;
use App\Models\NewsletterSource;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rules\Enum;

class NewsletterUpdateRequest extends FormRequest
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
            'title' => 'required|max:191',
            'spot' => 'required|max:500',
            'content' => 'required|min:30',
            "cover_image" => "nullable|mimes:jpg,jpeg,png",
            "inside_image" => "nullable|mimes:jpg,jpeg,png",
            "newsletter_publication_status_id" => "required|exists:newsletter_publication_statuses,id",
            "category_id" => "required|exists:categories,id",
            "newsletter_source_id" => "required|exists:newsletter_sources,id",
            "publish_date" => "nullable|date_format:d/m/Y H:i",
            'is_main_headline' => ['required', new Enum(NewsletterGeneralEnum::class)],
            'is_five_cuff' => ['required', new Enum(NewsletterGeneralEnum::class)],
            'is_outstanding' => ['required', new Enum(NewsletterGeneralEnum::class)],
            'is_last_minute' => ['required', new Enum(NewsletterGeneralEnum::class)],
            'is_today_headline' => ['required', new Enum(NewsletterGeneralEnum::class)],
            'is_special_news' => ['required', new Enum(NewsletterGeneralEnum::class)],
            'is_street_interview' => ['required', new Enum(NewsletterGeneralEnum::class)],
            'five_cuff_image' => [
                'sometimes',
                'nullable', // Bu alan zorunlu değil
                'required_if:is_five_cuff,' . NewsletterGeneralEnum::ON->value, // Eğer is_five_cuff ON ise gerekli
                'mimes:jpg,jpeg,png'
            ],
            'tags' => 'required|array',
            'is_seo' => 'nullable',
            'seo' => ['sometimes', 'required_if:is_seo,' . NewsletterGeneralEnum::ON->value, 'array'],
            'newsletter_id' => 'required|exists:newsletters,id'
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'newsletter_id' => CustomHelper::getIdByUuid(Newsletter::class, $this->input('newsletter_uuid')),
            'newsletter_publication_status_id' => CustomHelper::getIdByUuid(NewsletterPublicationStatus::class, $this->get('publication_status')),
            'category_id' => CustomHelper::getIdByUuid(Category::class, $this->get('category')),
            'newsletter_source_id' => CustomHelper::getIdByUuid(NewsletterSource::class, $this->get('newsletter_source')),
            "is_main_headline" => $this->get('is_main_headline')  === 'on' ? NewsletterGeneralEnum::ON->value : NewsletterGeneralEnum::OFF->value,
            "is_five_cuff" => $this->get('is_five_cuff')  === 'on' ? NewsletterGeneralEnum::ON->value : NewsletterGeneralEnum::OFF->value,
            "is_outstanding" => $this->get('is_outstanding')  === 'on' ? NewsletterGeneralEnum::ON->value : NewsletterGeneralEnum::OFF->value,
            "is_last_minute" => $this->get('is_last_minute')  === 'on' ? NewsletterGeneralEnum::ON->value : NewsletterGeneralEnum::OFF->value,
            "is_today_headline" => $this->get('is_today_headline')  === 'on' ? NewsletterGeneralEnum::ON->value : NewsletterGeneralEnum::OFF->value,
            "is_special_news" => $this->get('is_special_news')  === 'on' ? NewsletterGeneralEnum::ON->value : NewsletterGeneralEnum::OFF->value,
            "is_street_interview" => $this->get('is_street_interview')  === 'on' ? NewsletterGeneralEnum::ON->value : NewsletterGeneralEnum::OFF->value,
            "is_seo" => $this->get('is_seo')  === 'on' ? NewsletterGeneralEnum::ON->value : NewsletterGeneralEnum::OFF->value,
        ]);
    }

    public function attributes()
    {
        return [
            'title' => 'Başlık',
            'spot' => 'Spot',
            'content' => 'İçerik',
            "cover_image" => "Kapak Görsel",
            "inside_image" => "İç Görsel",
            "publication_status_id" => "Yayın Durumu",
            "category_id" => "Kategori",
            "newsletter_source_id" => "Haber Kaynağı",
            "publish_date" => "Yayın Tarihi",
            "five_cuff_image" => "Beşli Manşet",
            'tags' => 'Etiket',
            'is_seo' => 'Seo Otomatik',
            'seo' => 'Seo',
        ];
    }
}

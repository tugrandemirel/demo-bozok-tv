<?php

namespace App\Http\Requests\Admin\Ads;

use App\Enum\Ads\AdsIsActiveEnum;
use App\Helpers\Custom\CustomHelper;
use App\Helpers\Response\ResponseHelper;
use App\Models\AdType;
use App\Models\Placement;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rules\Enum;

class AdsStoreRequest extends FormRequest
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
            "url" => "nullable|string|max:191",
            'file' => 'nullable|mimes:jpg,jpeg,png',
            "ad_code" => "nullable",
            "ad_type_id" => "required|exists:ad_types,id",
            "placement_id" => "required|exists:placements,id",
            "start_date" => "nullable|date_format:Y-m-d H:i:s",
            "end_date" => "nullable|date_format:Y-m-d H:i:s",
            "is_active" => ["required", new Enum(AdsIsActiveEnum::class)]
        ];
    }

    protected function prepareForValidation(): void
    {
        $ad_type_id = CustomHelper::getIdByCode(AdType::class, $this->input('ad_type'));
        $placement_id = CustomHelper::getIdByCode(Placement::class, $this->input('placement'));

        $this->merge([
            "ad_type_id" => $ad_type_id,
            "placement_id" => $placement_id,
            "is_active" => $this->input('is_active') === 'on' ?  AdsIsActiveEnum::ACTIVE->value : AdsIsActiveEnum::PASSIVE->value,
        ]);
    }
}

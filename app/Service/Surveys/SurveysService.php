<?php

namespace App\Service\Surveys;

use App\Helpers\Response\ResponseHelper;
use App\Http\Requests\Admin\Surveys\SurveyFilterRequest;
use App\Models\Survey;
use Yajra\DataTables\Facades\DataTables;

class SurveysService
{
    public function getAllDataForDatatable(SurveyFilterRequest $request)
    {
        try {
            $surveys = Survey::query()
                ->orderByDesc('created_at');
            return DataTables::eloquent($surveys)->toJson();
        } catch (\Exception $exception) {
            ResponseHelper::error('Bir hata ile karşılaşıdı.', [$exception->getMessage()]);
        }
    }
}

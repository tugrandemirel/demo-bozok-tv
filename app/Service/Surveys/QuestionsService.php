<?php

namespace App\Service\Surveys;

use App\Helpers\Response\ResponseHelper;
use App\Http\Requests\Admin\Surveys\Questions\QuestionFilterRequest;
use App\Models\SurveyQuestion;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class QuestionsService
{
    public function getAllDataForDatatable(QuestionFilterRequest $request)
    {
        $attributes = collect($request->validated());
        $survey_uuid = $attributes->get('survey_uuid');
        try {
            // TODO Katılımcı sayısı getirilecek. Bunun cevabı daha verilmedi. Şuan acelesi olmadığından kaynaklı olarak. Durum doğrultusunda Tablo yapısı değişebilir.
            $questions = SurveyQuestion::query()
                ->select("survey_questions.question_text", "survey_questions.uuid as survey_question_uuid")
                ->addSelect(DB::raw('COUNT(question_answer_options.id) as options_count'))
                ->join("surveys", "surveys.id", "survey_questions.survey_id")
                ->join('question_answer_options', 'question_answer_options.survey_question_id', '=', "survey_questions.id")
                ->where("surveys.uuid", $survey_uuid)
                ->groupBy("survey_questions.id")
                ->orderByDesc('order')
                ->get();
            return DataTables::collection($questions)->toJson(JSON_PRETTY_PRINT);
        } catch (\Exception $exception) {
            ResponseHelper::error('Bir hata ile karşılaşıdı.', [$exception->getMessage()]);
        }
    }
}

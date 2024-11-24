<?php

namespace App\Http\Controllers\Admin\Surveys;

use App\Helpers\Response\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Surveys\Questions\QuestionFilterRequest;
use App\Http\Requests\Admin\Surveys\Questions\QuestionStoreRequest;
use App\Models\Survey;
use App\Models\SurveyQuestion;
use App\Models\User;
use App\Service\Surveys\QuestionsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class QuestionController extends Controller
{
    protected QuestionsService $questions_service;

    public function __construct(QuestionsService $questions_service)
    {
        $this->questions_service = $questions_service;
    }

    public function index(QuestionFilterRequest $request)
    {
        if ($request->ajax()) {
            return $this->questions_service->getAllDataForDatatable($request);
        }
        return ResponseHelper::error('bir hata ile karşılaşıldı.');
    }

    public function store(QuestionStoreRequest $request)
    {
        $attributes = collect($request->validated());
        $survey_uuid = $attributes->get("survey_uuid");
        $attributes->forget("survey_uuid");
        $answer_text = $attributes->get("answer_text");
        $attributes->forget("answer_text");

        DB::beginTransaction();
        try {
            /** @var User $user_id */
            $user_id = auth()->id();

            $attributes->put('created_by_user_id', $user_id);
            $attributes->put('uuid', Str::uuid());

            /** @var Survey $survey */
            $survey = Survey::query()
                ->where("uuid", $survey_uuid)
                ->first();

            /** @var SurveyQuestion $question */
            $question = $survey->questions()
                ->create($attributes->toArray());

            $answer_text = collect($answer_text)->map(function ($answer) use ($user_id) {
                return [
                    'created_by_user_id' => $user_id,
                    'uuid' => Str::uuid(),
                    'answer_text' => $answer
                ];
            });
            foreach ($answer_text as $answer) {
                $question->options()->create($answer);
            }


            DB::commit();
            return ResponseHelper::success('Başarılı bir şekilde soru oluşturuldu');
        } catch (\Exception $exception) {
            DB::rollback();dd($exception->getMessage());
            return ResponseHelper::error('Soru oluşturulurken bir hata ile karşılaşıldı.', [$exception->getMessage()]);
        }
    }
}

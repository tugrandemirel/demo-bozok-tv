<?php

namespace App\Http\Controllers\Admin\Surveys;

use App\Helpers\Response\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Surveys\Questions\QuestionFilterRequest;
use App\Http\Requests\Admin\Surveys\Questions\QuestionStoreRequest;
use App\Http\Requests\Admin\Surveys\Questions\QuestionUpdateRequest;
use App\Models\Survey;
use App\Models\SurveyQuestion;
use App\Models\User;
use App\Service\Surveys\QuestionsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class QuestionController extends Controller
{
    protected QuestionsService $questions_service;

    public function __construct(QuestionsService $questions_service)
    {
        $this->questions_service = $questions_service;
    }

    public function index(QuestionFilterRequest $request): ?JsonResponse
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

            $answer_text = $this->mappingAnswertText($answer_text);
            foreach ($answer_text as $answer) {
                $question->options()->create($answer);
            }

            DB::commit();
            return ResponseHelper::success('Başarılı bir şekilde soru oluşturuldu');
        } catch (\Exception $exception) {
            DB::rollback();
            return ResponseHelper::error('Soru oluşturulurken bir hata ile karşılaşıldı.', [$exception->getMessage()]);
        }
    }

    public function edit(string $question_uuid): JsonResponse
    {
        try {
            $survey_question = SurveyQuestion::query()
                ->select("question_text", "uuid", "id")
                ->where("uuid", $question_uuid)
                ->with(['options' => fn($query) => $query->select("survey_question_id", "answer_text", "id")])
                ->first();

            return ResponseHelper::success('Anket çekme işlemi başarılı bir şekilde gerçekleştirildi', $survey_question);
        } catch (\Exception $exception) {
            return ResponseHelper::error('Bir hata ile karşılaşıldı.', [$exception->getMessage()]);
        }
    }

    public function update(QuestionUpdateRequest $request)
    {
        $attributes = collect($request->validated());

        $question_uuid = $attributes->get("uuid");
        $attributes->forget("uuid");

        $answer_text = $attributes->get("answer_text");
        $attributes->forget("answer_text");

        DB::beginTransaction();
        try {
            /** @var SurveyQuestion $question */
            $question = SurveyQuestion::query()
                ->where('uuid', $question_uuid)
                ->first();

            $question->update($attributes->toArray());

            $question->options()->delete();

            $answer_text = $this->mappingAnswertText($answer_text);

            foreach ($answer_text as $answer) {
                $question->options()->create($answer);
            }

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            return ResponseHelper::error('Bir hata ile karşılaşıldı.', [$exception->getMessage()]);
        }
    }

    /**
     * @param $answer_text
     * @return Collection
     */
    protected function mappingAnswertText($answer_text)
    {
        return collect($answer_text)->map(function ($answer) {
            return [
                'created_by_user_id' => auth()->id(),
                'uuid' => Str::uuid(),
                'answer_text' => $answer
            ];
        });
    }
}

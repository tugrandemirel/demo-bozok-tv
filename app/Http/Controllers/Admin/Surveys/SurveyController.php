<?php

namespace App\Http\Controllers\Admin\Surveys;

use App\Helpers\Response\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Surveys\SurveyDestroyRequest;
use App\Http\Requests\Admin\Surveys\SurveyFilterRequest;
use App\Http\Requests\Admin\Surveys\SurveyStoreRequest;
use App\Http\Requests\Admin\Surveys\SurveyUpdateRequest;
use App\Models\Survey;
use App\Service\Surveys\SurveysService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Mockery\Exception;

class SurveyController extends Controller
{
    const PATH = 'admin.surveys.';
    protected SurveysService $surveys_service;
    public function __construct(SurveysService $surveys_service)
    {
        $this->surveys_service = $surveys_service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(SurveyFilterRequest $request)
    {
        if ($request->ajax()) {
            return $this->surveys_service->getAllDataForDatatable($request);
        }
        return view(self::PATH.'index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SurveyStoreRequest $request): JsonResponse
    {
        $attributes = collect($request->validated());
        try {
            $attributes->put('uuid', Str::uuid());
            $attributes->put('created_by_user_id', auth()->id());

            Survey::query()
                ->create($attributes->toArray());

            return ResponseHelper::success('Anket oluşturma işlemi başarılı bir şekilde gerçekleştirildi.', [], 200);
        } catch (\Exception $exception) {
            return ResponseHelper::error('Bir hata ile karşılaşıldı.', [$exception->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $survey_uuid)
    {
        try {
            $survey = Survey::query()
                ->where('uuid', $survey_uuid)
                ->with(['questions.options'])
                ->withCount('questions')
                ->first();

            $options_count = $survey->questions->sum(fn($question) => $question->options->count());

            return view(self::PATH.'show.index', compact('survey', 'options_count'));
        } catch (Exception $exception) {
            abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $survey_uuid)
    {
        try{
            $survey = Survey::query()
                ->where('uuid', $survey_uuid)
                ->first();

            return ResponseHelper::success('Başarılı bir şekilde veri çekildi', $survey);
        } catch (\Exception $exception) {
            return ResponseHelper::error('Bir hata ile karşılaşıldı.', [$exception->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SurveyUpdateRequest $request): JsonResponse
    {
        $attributes = collect($request->validated());
        $survey_uuid = $attributes->get('uuid');
        $attributes->forget('uuid');
        try {
            /** @var Survey $survey */
            $survey = Survey::query()
                ->where('uuid', $survey_uuid)
                ->first();

            $survey->update($attributes->toArray());

            return ResponseHelper::success('Anket güncelleme işlemi başarılı bir şekilde gerçekleştirildi.');
        }catch (\Exception $exception) {
            return ResponseHelper::error('Bir hata ile karşılaşıldı.', [$exception->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SurveyDestroyRequest $request): JsonResponse
    {
        $attributes = collect($request->validated());
        try {
            /** @var Survey $survey */
            $survey = Survey::query()
                ->where('uuid', $attributes->get('survey_uuid'))
                ->first();

            $survey->questions->each(function ($question) {
                $question->options()->delete();
            });

            $survey->questions()->delete();

            // Anketi sil
            $survey->delete();

            return ResponseHelper::success('Soru işlemi başarılı bir şekilde gerçekleştirildi');
        } catch (\Exception $exception) {
            return ResponseHelper::error('Bir hata ile karşılaşıldı.', [$exception->getMessage()]);
        }
    }
}

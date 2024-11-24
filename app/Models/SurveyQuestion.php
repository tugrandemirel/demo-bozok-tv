<?php

namespace App\Models;

use App\Traits\ActivityLoggerTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class SurveyQuestion extends Model implements Sortable
{
    use HasFactory, SoftDeletes, SortableTrait, ActivityLoggerTrait;

    protected $fillable = [
        'uuid',
        'created_by_user_id',
        'survey_id',
        'question_text',
        'order'
    ];

    public $sortable = [
        'order_column_name' => 'order',
        'sort_when_creating' => true,
    ];

    public function buildSortQuery(): Builder
    {
        return static::query()->where('survey_id', $this->survey_id);
    }

    public function survey(): BelongsTo
    {
        return $this->belongsTo(Survey::class, 'survey_id');
    }

    public function options(): HasMany
    {
        return $this->hasMany(QuestionAnswerOption::class);
    }

    protected static function booted(): void
    {
        static::created(function ($survey_question) {
            $survey_question->logActivity('survey_question_created', 'Yeni bir Soru oluşturdu.', $survey_question);
        });

        static::updated(function ($survey_question) {
            $survey_question->logActivity('survey_question_updated', 'Soru güncellendi.', $survey_question);
        });

        static::deleted(function ($survey_question) {
            $survey_question->logActivity('survey_question_deleted', 'Soru silindi.', $survey_question);
        });
    }
}

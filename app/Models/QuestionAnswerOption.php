<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuestionAnswerOption extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "uuid",
        "survey_question_id",
        "created_by_user_id",
        "answer_text",

    ];

    public function question(): BelongsTo
    {
        return $this->belongsTo(SurveyQuestion::class);
    }
}

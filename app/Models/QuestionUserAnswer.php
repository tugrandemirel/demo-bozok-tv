<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuestionUserAnswer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'uuid',
        'selected_option_id',
        'user_id',
        'session_id',
    ];

    public function questionAnswerOption(): BelongsTo
    {
        return $this->belongsTo(QuestionAnswerOption::class, 'selected_option_id');
    }


    public function surveyUserKvkkData(): HasOne
    {
        return $this->hasOne(SurveyUserKvkkData::class);
    }
}

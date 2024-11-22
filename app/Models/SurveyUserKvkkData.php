<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class SurveyUserKvkkData extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "uuid",
        "question_user_answer_id",
        "ip_address",
        "browser",
        "os",
        "location",
    ];

    public function questionUserAnswer(): BelongsTo
    {
        return $this->belongsTo(QuestionUserAnswer::class);
    }
}

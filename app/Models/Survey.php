<?php

namespace App\Models;

use App\Enum\Survey\SurveyStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Survey extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'uuid',
        'created_by_user_id',
        'title',
        'description',
        'start_date',
        'end_date',
        'status',
    ];

    protected $casts = [
        'status' => SurveyStatusEnum::class
    ];

    public function questions(): HasMany
    {
        return $this->hasMany(SurveyQuestion::class);
    }
}

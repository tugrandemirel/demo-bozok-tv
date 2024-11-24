<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserActivity extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'activity_type_id',
        'activityable_id',
        'activityable_type',
        'description',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function activityType(): BelongsTo
    {
        return $this->belongsTo(ActivityType::class);
    }

    public function activityable(): MorphTo
    {
        return $this->morphTo();
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostReview extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "user_id",
        "post_id",
        "post_status_id",
        "review_note",
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(PostStatus::class, "post_status_id");
    }
}

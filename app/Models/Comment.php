<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "uuid",
        "comment_status_id",
        "commentable_type",
        "commentable_id",
        'user_id',
        'guest_name',
        'content',
        'is_accepted',
        'parent_id',
    ];


    public function status()
    {
        return $this->belongsTo(CommentStatus::class, "comment_status_id");
    }
}

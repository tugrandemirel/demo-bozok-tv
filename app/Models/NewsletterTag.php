<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class NewsletterTag extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'newsletter_id',
        'tag_id'
    ];

    public function newsletter(): BelongsTo
    {
        return $this->belongsTo(Newsletter::class);
    }

    public function tag(): BelongsTo
    {
        return $this->belongsTo(Newsletter::class);
    }
}

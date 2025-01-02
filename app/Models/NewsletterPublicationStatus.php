<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsletterPublicationStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'created_by_user_id',
        'name',
        'code',
    ];

    public function scopeOnTheAir($query)
    {
        return $query->where('code', 'on-the-air')->first();
    }

    public function scopeArchive($query)
    {
        return $query->where('code', 'archive')->first();
    }

    public function scopeDraft($query)
    {
        return $query->where('code', 'draft')->first();
    }

    public function scopeRemoved($query)
    {
        return $query->whereNot('code', 'removed');
    }
}

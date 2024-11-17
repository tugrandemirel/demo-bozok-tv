<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostStatus extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "name",
        "code",
    ];

    public function scopePending($query)
    {
        return $query->where('code', 'pending');
    }

    public function scopeRejected($query)
    {
        return $query->where('code', 'rejected');
    }
}

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
}

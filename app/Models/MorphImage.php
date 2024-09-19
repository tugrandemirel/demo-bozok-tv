<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MorphImage extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'morphable_id',
        'morphable_type',
        'image_name',
        'image_ext',
        'size',
        'path',
        'alt_text',
        'width',
        'height',
        'mime_type',
        'image_type',
    ];
}

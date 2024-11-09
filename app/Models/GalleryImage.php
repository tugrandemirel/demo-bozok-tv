<?php

namespace App\Models;

use App\Enum\Gallery\GalleryImage\GalleryImageEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\EloquentSortable\SortableTrait;

class GalleryImage extends Model
{
    use HasFactory, SoftDeletes, SortableTrait;

    protected $fillable = [
        'uuid',
        'gallery_id',
        'created_by_user_id',
        'image_name',
        'image_ext',
        'size',
        'path',
        'alt_text',
        'width',
        'height',
        'mime_type',
        'is_active',
    ];

    protected $casts = [
        'is_active' => GalleryImageEnum::class
    ];

    public $sortable = [
        'order_column_name' => 'order',
        'sort_when_creating' => true,
    ];

}

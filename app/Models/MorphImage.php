<?php

namespace App\Models;

use App\Enum\MorphImage\MorphImageImageTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static  cover()
 * @method static  inside()
 * @method static  featured()
 * @method static  gallery()
 */
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

    protected $casts = [
        'image_type' => MorphImageImageTypeEnum::class
    ];

    /** KAPAK FOTOĞRAFI */
    /**
     * @param $query
     * @return mixed
     */
    public function scopeCover($query)
    {
        return $query->where('image_type', MorphImageImageTypeEnum::COVER)
            ->where('imageable_type', Newsletter::class);
    }

    /** IC KAPAK FOTOĞRAFI */
    /**
     * @param $query
     * @return mixed
     */
    public function scopeInside($query)
    {
        return $query->where('image_type', MorphImageImageTypeEnum::INSIDE)
            ->where('imageable_type', Newsletter::class);
    }

    public function scopeFeatured($query)
    {
        return $query->where('image_type', MorphImageImageTypeEnum::FEATURED)
            ->where('imageable_type', Newsletter::class);
    }

    public function scopeGallery($query)
    {
        return $query->where('imageable_type', Gallery::class);
    }

    public function imageable()
    {
        return $this->morphTo();
    }
}

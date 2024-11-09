<?php

namespace App\Models;

use App\Enum\Gallery\GalleryIsActiveEnum;
use App\Enum\Gallery\GalleryTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

/**
 * @method static videoGalleries()
 */
class Gallery extends Model
{
    use HasFactory, SoftDeletes, HasSlug, SortableTrait;

    protected $fillable = [
        'uuid',
        'created_by_user_id',
        'title',
        'slug',
        'description',
        'type',
        'order',
        'is_active',
    ];

    protected $casts = [
        'type' => GalleryTypeEnum::class,
        'is_active' => GalleryIsActiveEnum::class
    ];

    public $sortable = [
        'order_column_name' => 'order',
        'sort_when_creating' => true,
    ];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }


    public function image()
    {
        return $this->morphOne(MorphImage::class, 'imageable');
    }

    public function images(): HasMany
    {
        return $this->hasMany(GalleryImage::class);
    }

    public function videos(): HasMany
    {
        return $this->hasMany(VideoGallery::class);
    }

}

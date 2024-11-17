<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Post extends Model implements Sortable
{
    use HasFactory, HasSlug, SortableTrait;

    protected $fillable = [
        "uuid",
        "title",
        "user_id",
        "post_status_id",
        "slug",
        "content",
        "order",
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

    public function image():MorphOne
    {
        return $this->morphOne(MorphImage::class, 'imageable');
    }

    public function seoSetting():MorphOne
    {
        return $this->morphOne(SeoSetting::class, 'seoable');
    }
}

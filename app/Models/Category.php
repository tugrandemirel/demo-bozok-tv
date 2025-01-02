<?php

namespace App\Models;

use App\Enum\Category\CategoryIsActiveEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Category extends Model implements Sortable
{
    use HasFactory, SoftDeletes, HasSlug, SortableTrait;


    protected $fillable = [
        'uuid',
        'created_by_user_id',
        'parent_id',
        'name',
        'slug',
        'order',
        'is_active',
        'home_page',
    ];

    protected $casts = [
        'is_active' => CategoryIsActiveEnum::class
    ];

    public $sortable = [
        'order_column_name' => 'order',
        'sort_when_creating' => true,
    ];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function createdByUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by_user_id');
    }

    public function seoSettings(): MorphMany
    {
        return $this->morphMany(SeoSetting::class, 'seoable');
    }

    public function seoSetting(): MorphOne
    {
        return $this->morphOne(SeoSetting::class, 'seoable');
    }
}

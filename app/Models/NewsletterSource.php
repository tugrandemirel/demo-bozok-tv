<?php

namespace App\Models;

use App\Enum\NewsletterSource\NewsletterSourceIsActiveEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class NewsletterSource extends Model
{
    use HasFactory, SoftDeletes, HasSlug, SortableTrait;

    protected $fillable = [
        'uuid',
        'created_by_user_id',
        'name',
        'slug',
        'url',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => NewsletterSourceIsActiveEnum::class
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

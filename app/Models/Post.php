<?php

namespace App\Models;

use App\Traits\ActivityLoggerTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Post extends Model implements Sortable
{
    use HasFactory, HasSlug, SortableTrait, ActivityLoggerTrait;

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

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(PostReview::class);
    }

    public function activities(): MorphMany
    {
        return $this->morphMany(UserActivity::class, 'activityable');
    }


    protected static function booted(): void
    {
        static::created(function ($post) {
            $post->logActivity('post_created', 'Yeni bir Köşe Yazısı oluşturdu.', $post);
        });

        static::updated(function ($post) {
            $post->logActivity('post_updated', 'Köşe Yazısı güncellendi.', $post);
        });

        static::deleted(function ($post) {
            $post->logActivity('post_deleted', 'Köşe Yazısı silindi.', $post);
        });
    }
}

<?php

namespace App\Models;

use App\Enum\Newsletter\NewsletterGeneralEnum;
use App\Http\Controllers\Admin\Newsletter\NewsletterController;
use App\Traits\ActivityLoggerTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Newsletter extends Model implements Sortable
{
    use HasFactory, SoftDeletes, HasSlug, SortableTrait, ActivityLoggerTrait;

    protected $fillable = [
        'uuid',
        'category_id',
        'newsletter_source_id',
        'newsletter_publication_status_id',
        'created_by_user_id',
        'title',
        'slug',
        'spot',
        'content',
        'publish_date',
        'order',
    ];

    protected $casts = [
        'is_main_headline' => NewsletterGeneralEnum::class,
        'is_seo' => NewsletterGeneralEnum::class,
        'publish_date' => 'datetime'
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

    public function images(): MorphMany
    {
        return $this->morphMany(MorphImage::class, 'imageable');
    }

    public function image(): MorphOne
    {
        return $this->morphOne(MorphImage::class, 'imageable');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, "category_id");
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(NewsletterPublicationStatus::class, "newsletter_publication_status_id");
    }

    public function source(): BelongsTo
    {
        return $this->belongsTo(NewsletterSource::class, "newsletter_source_id");
    }

    /**
     * Newsletter ile ilişkili MainHeadline'ı alır.
     */
    public function mainHeadlines(): MorphOne
    {
        return $this->morphOne(MainHeadline::class, 'headlineable');
    }

    public function seoSetting(): MorphOne
    {
        return $this->morphOne(SeoSetting::class, 'seoable');
    }

    public function newsletterTags()
    {
        return $this->hasMany(NewsletterTag::class);
    }

    public function outstandings(): HasOne
    {
        return $this->hasOne(NewsletterOutstanding::class);
    }

    public function fiveCuff(): HasOne
    {
        return $this->hasOne(NewsletterFiveCuff::class);
    }

    public function lastMinute(): HasOne
    {
        return $this->hasOne(NewsletterLastMinute::class);
    }

    public function todayHeadline(): HasOne
    {
        return $this->hasOne(NewsletterTodayHeadline::class);
    }

    public function activities(): MorphMany
    {
        return $this->morphMany(UserActivity::class, 'activityable');
    }

    /*protected static function booted(): void
    {
        static::created(function ($newsletter) {
            $newsletter->logActivity('newsletter_created', 'Yeni bir Haber oluşturdu.', $newsletter);
        });

        static::updated(function ($newsletter) {
            $newsletter->logActivity('newsletter_updated', 'Haber güncellendi.', $newsletter);
        });

        static::deleted(function ($newsletter) {
            $newsletter->logActivity('newsletter_deleted', 'Haber silindi.', $newsletter);
        });
    }*/
}

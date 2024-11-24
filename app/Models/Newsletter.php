<?php

namespace App\Models;

use App\Enum\Newsletter\NewsletterGeneralEnum;
use App\Traits\ActivityLoggerTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
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
        'is_main_headline',
        'is_five_cuff',
        'is_outstanding',
        'is_last_minute',
        'is_today_headline',
        'is_special_news',
        'is_street_interview',
        'is_seo',
        'publish_date',
        'order',
    ];

    protected $casts = [
        'is_main_headline' => NewsletterGeneralEnum::class,
        'is_five_cuff' => NewsletterGeneralEnum::class,
        'is_outstanding' => NewsletterGeneralEnum::class,
        'is_last_minute' => NewsletterGeneralEnum::class,
        'is_today_headline' => NewsletterGeneralEnum::class,
        'is_special_news' => NewsletterGeneralEnum::class,
        'is_street_interview' => NewsletterGeneralEnum::class,
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

    public function seoSetting(): MorphOne
    {
        return $this->morphOne(MorphImage::class, 'seoable');
    }

    public function newsletterTags()
    {
        return $this->hasMany(NewsletterTag::class);
    }

    public function activities(): MorphMany
    {
        return $this->morphMany(UserActivity::class, 'activityable');
    }

    protected static function booted(): void
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
    }
}

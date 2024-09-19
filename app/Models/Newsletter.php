<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Newsletter extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'uuid',
        'category_id',
        'newsletter_source_id',
        'newsletter_publication_status_id',
        'created_by_user_id',
        'title',
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
    ];

    public function images(): MorphMany
    {
        return $this->morphMany(MorphImage::class, 'imageable');
    }

    public function seoSettings(): MorphMany
    {
        return $this->morphMany(MorphImage::class, 'seoable');
    }

    public function newsletterTags()
    {
        return $this->hasMany(NewsletterTag::class);
    }
}

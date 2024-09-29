<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static newsletter()
 */
class SeoSetting extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'uuid',
        'seoable_id',
        'seoable_type',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'canonical_url',
        'og_title',
        'og_description',
        'og_image',
        'twitter_title',
        'twitter_description',
        'twitter_image',
        'created_by_user_id'
    ];

    public function scopeNewsletter($query)
    {
        return $query->where('seoable_type', Newsletter::class);
    }
}

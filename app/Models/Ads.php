<?php

namespace App\Models;

use App\Enum\Ads\AdsIsActiveEnum;
use App\Traits\ActivityLoggerTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class Ads extends Model implements Sortable
{
    use HasFactory, SoftDeletes, SortableTrait, ActivityLoggerTrait;

    protected $fillable = [
        'uuid',
        'created_by_user_id',
        'ad_type_id',
        'placement_id',
        'url',
        'ad_code',
        'start_date',
        'end_date',
        'is_active',
        'order',
    ];

    public $sortable = [
        'order_column_name' => 'order',
        'sort_when_creating' => true,
    ];

    protected $casts = [
        "is_active" => AdsIsActiveEnum::class
    ];

    public function image(): MorphOne
    {
        return $this->morphOne(MorphImage::class, 'imageable');
    }

    /**
     * Ads ile ilişkili MainHeadline'ı alır.
     */
    public function mainHeadlines(): MorphTo
    {
        return $this->morphTo(MainHeadline::class, 'headlineable');
    }

    protected static function booted(): void
    {
        static::created(function ($ads) {
            $ads->logActivity('ads_created', 'Yeni bir Reklam oluşturdu.', $ads);
        });

        static::updated(function ($ads) {
            $ads->logActivity('ads_updated', 'Reklam güncellendi.', $ads);
        });

        static::deleted(function ($ads) {
            $ads->logActivity('ads_deleted', 'Reklam silindi.', $ads);
        });
    }
}

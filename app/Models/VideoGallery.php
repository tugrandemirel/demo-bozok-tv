<?php

namespace App\Models;

use App\Enum\Gallery\VideoGallery\VideoGalleryIsActiveEnum;
use App\Helpers\Custom\CustomHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class VideoGallery extends Model implements Sortable
{
    use HasFactory, SoftDeletes, SortableTrait;

    protected $fillable = [
        'uuid',
        'created_by_user_id',
        'gallery_id',
        'video_url',
        'caption',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => VideoGalleryIsActiveEnum::class
    ];

    public $sortable = [
        'order_column_name' => 'order',
        'sort_when_creating' => true,
    ];

    protected $appends = [
        'embed'
    ];

    public function getEmbedAttribute()
    {
        return CustomHelper::getEmbed($this->video_url);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class MainHeadline extends Model implements Sortable
{
    use HasFactory, SortableTrait;

    protected $fillable = [
        "uuid",
        "created_by_user_id",
        "headlineable_type",
        "headlineable_id",
        "order"
    ];

    public $sortable = [
        'order_column_name' => 'order',
        'sort_when_creating' => true,
    ];

    /**
     * Polimorfik ilişki, Ads veya Newsletter ile ilişkilendirir.
     */
    public function headlineable(): MorphTo
    {
        return $this->morphTo();
    }
}

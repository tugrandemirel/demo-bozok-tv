<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class NewsletterLastMinute extends Model implements Sortable
{
    use HasFactory, SortableTrait;

    protected $fillable = [
        "newsletter_id",
        "order",
    ];

    public $sortable = [
        'order_column_name' => 'order',
        'sort_when_creating' => true,
    ];
}

<?php

namespace App\Service\Gallery;

use App\Http\Resources\Admin\Gallery\GalleryResource;
use App\Models\Gallery;
use Illuminate\Pagination\LengthAwarePaginator;

class GalleryService
{
    public function getAllData()
    {
        /** @var LengthAwarePaginator $galleries */
        $galleries = Gallery::query()
            ->select('galleries.uuid as gallery_uuid', 'galleries.title', 'galleries.description', 'galleries.is_active')
            ->addSelect('galleries.created_at', 'galleries.type')
            ->addSelect('morph_images.path')
            ->join('morph_images', function ($join) {
                $join->on('morph_images.imageable_id', '=', 'galleries.id')
                    ->where('morph_images.imageable_type', Gallery::class);
            })
            ->paginate(18);
        return $galleries;
    }
}

<?php

namespace App\Repositories\Api\V2\Galleries;

use App\Enum\Gallery\GalleryIsActiveEnum;
use App\Enum\Gallery\GalleryTypeEnum;
use App\Http\Resources\Api\V2\Galleries\PhotoGalleryResource;
use App\Models\Gallery;

class PhotoGalleryRepository
{
    public function getGalleries()
    {
        $photo_galleries = Gallery::query()
            ->select("galleries.*")
            ->addSelect("morph_images.path as path")
            ->where("galleries.is_active", GalleryIsActiveEnum::ACTIVE)
            ->where("galleries.type", GalleryTypeEnum::IMAGE)
            ->join("morph_images", function ($join) {
                $join->on("galleries.id", "=", "morph_images.imageable_id")
                    ->where("morph_images.imageable_type", Gallery::class);
            })
            ->limit(10)
            ->get();

        return $photo_galleries;
    }
}

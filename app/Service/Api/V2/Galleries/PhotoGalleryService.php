<?php

namespace App\Service\Api\V2\Galleries;

use App\Http\Resources\Api\V2\Galleries\PhotoGalleryResource;
use App\Repositories\Api\V2\Galleries\PhotoGalleryRepository;

class PhotoGalleryService
{
    private PhotoGalleryRepository $photo_gallery_repository;
    public function __construct(PhotoGalleryRepository $photo_gallery_repository)
    {
        $this->photo_gallery_repository = $photo_gallery_repository;
    }

    public function getGalleries()
    {
        $photo_galleries = $this->photo_gallery_repository->getGalleries();
        return  PhotoGalleryResource::collection($photo_galleries);
    }
}

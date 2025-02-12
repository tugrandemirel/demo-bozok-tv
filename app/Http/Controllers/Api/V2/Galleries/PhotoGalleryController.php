<?php

namespace App\Http\Controllers\Api\V2\Galleries;

use App\Helpers\Response\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Service\Api\V2\Galleries\PhotoGalleryService;
use Illuminate\Http\Request;

class PhotoGalleryController extends Controller
{
    private PhotoGalleryService $photo_gallery_service;

    public function __construct(PhotoGalleryService $photo_gallery_service)
    {
        $this->photo_gallery_service = $photo_gallery_service;
    }

    public function index()
    {
        $photo_galleries = $this->photo_gallery_service->getGalleries();
        return ResponseHelper::success("Foto galeri başarılı bir şekilde çekildi.", ["data" => $photo_galleries], 200);
    }
}

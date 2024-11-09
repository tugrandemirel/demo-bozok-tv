<?php

namespace App\Http\Controllers\Admin\Gallery;

use App\Helper\ImageHelper;
use App\Helpers\Response\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Gallery\GalleryImage\GalleryImageStoreRequest;
use App\Http\Requests\Admin\Gallery\GalleryImage\GalleryImageUpdateRequest;
use App\Models\Gallery;
use App\Models\GalleryImage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class GalleryImageController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(GalleryImageStoreRequest $request): JsonResponse
    {
        $attributes = collect($request->validated());
        $gallery_uuid = $attributes->get('gallery_uuid');
        $attributes->get('gallery_uuid');
        $file = $attributes->get('file');

        DB::beginTransaction();
        try {
            $user = auth()->user();

            /** @var Gallery $gallery */
            $gallery = Gallery::query()
                ->where('uuid', $gallery_uuid)
                ->first();
            if ($file) {
                $gallery_image =  ImageHelper::uploadImage($file);
                $gallery_image['uuid'] = Str::uuid();
                $gallery_image['alt_text'] = $attributes->get('alt_text');
                $gallery_image['created_by_user_id'] = $user->id;
                $gallery_image['is_active'] = $attributes->get('is_active');
                $gallery_image['order'] = $gallery->images()->max('order') + 1;
                $gallery->images()
                    ->create($gallery_image);

            } else {
                return ResponseHelper::error('Resim eklerken bir hata oluştu.', []);
            }


            DB::commit();
            return ResponseHelper::success('Resim Galeri ekleme işlemi başarılı bir şekilde gerçekleştirildi.');
        } catch (\Exception $exception) {
            DB::rollBack();
            return ResponseHelper::error('Bir hata oluştu', [$exception->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $image_uuid)
    {
        try {
            $gallery_image = GalleryImage::query()
                ->where('uuid', $image_uuid)
                ->first();

            return ResponseHelper::success('Galeri image edit işlemi başarılı bir şekilde gerçekleştirildi.', $gallery_image);
        } catch (\Exception $exception) {
            return ResponseHelper::error('Bir hata oluştu', [$exception->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GalleryImageUpdateRequest $request): JsonResponse
    {
        $attributes = collect($request->validated());
        $gallery_image_uuid = $request->get('uuid');

        $file = $attributes->get('update_file');
        $attributes->forget('update_file');
        DB::beginTransaction();
        try {
            $gallery_image = GalleryImage::query()
                    ->where('uuid', $gallery_image_uuid)
                    ->first();
            $image = [];
            if($file) {
                $image = ImageHelper::updateImage($file, $gallery_image->path);
            }
            $image['alt_text'] = $attributes->get('alt_text');
            $image['is_active'] = $attributes->get('is_active');

            $gallery_image->update($image);

            DB::commit();
            return ResponseHelper::success('Resim Galeri güncelleme işlemi başarılı bir şekilde gerçekleştirildi.');
        } catch (\Exception $exception) {
            DB::rollBack();
            return ResponseHelper::error('Bir hata oluştu', [$exception->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

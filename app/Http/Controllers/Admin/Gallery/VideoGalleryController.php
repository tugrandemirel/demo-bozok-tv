<?php

namespace App\Http\Controllers\Admin\Gallery;

use App\Enum\Gallery\GalleryTypeEnum;
use App\Helpers\Response\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Gallery\Video\VideoGalleryStoreRequest;
use App\Models\Gallery;
use App\Models\VideoGallery;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VideoGalleryController extends Controller
{
    public function store(VideoGalleryStoreRequest $request): JsonResponse
    {
        $attributes = collect($request->validated());
        $attributes->put('created_by_user_id', auth()->id());
        $attributes->put('order', VideoGallery::query()->max('order') + 1);

        $gallery_uuid = $attributes->get('gallery_uuid');
        $attributes->forget('gallery_uuid');

        DB::beginTransaction();
        try {
            $gallery = Gallery::query()
                ->where('uuid', $gallery_uuid)
                ->where('type', GalleryTypeEnum::VIDEO)
                ->first();

            $gallery->videoGalleries()
                ->create($attributes->toArray());

            DB::commit();

            return ResponseHelper::success('Video Galeri ekleme işlemi başarılı bir şekilde gerçekleştirildi.');
        } catch (\Exception $exception) {
            DB::rollBack();
            dd($exception->getMessage());
            return ResponseHelper::error('Bir hata oluştu', [$exception->getMessage()]);
        }
    }
}

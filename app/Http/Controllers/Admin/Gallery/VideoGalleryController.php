<?php

namespace App\Http\Controllers\Admin\Gallery;

use App\Enum\Gallery\GalleryTypeEnum;
use App\Helpers\Response\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Gallery\Video\VideoGalleryStoreRequest;
use App\Http\Requests\Admin\Gallery\Video\VideoGalleryUpdateRequest;
use App\Models\Gallery;
use App\Models\VideoGallery;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class VideoGalleryController extends Controller
{
    public function store(VideoGalleryStoreRequest $request): JsonResponse
    {
        $attributes = collect($request->validated());
        $attributes->put('created_by_user_id', auth()->id());
        $attributes->put('uuid', Str::uuid());

        $gallery_uuid = $attributes->get('gallery_uuid');
        $attributes->forget('gallery_uuid');

        DB::beginTransaction();
        try {
            $gallery = Gallery::query()
                ->where('uuid', $gallery_uuid)
                ->where('type', GalleryTypeEnum::VIDEO)
                ->first();

            $gallery->videos()
                ->create($attributes->toArray());

            DB::commit();

            return ResponseHelper::success('Video Galeri ekleme işlemi başarılı bir şekilde gerçekleştirildi.');
        } catch (\Exception $exception) {
            DB::rollBack();
            return ResponseHelper::error('Bir hata oluştu', [$exception->getMessage()]);
        }
    }

    public function edit($video_uuid): JsonResponse
    {
        try {
            $single_video = VideoGallery::query()
                ->where('uuid', $video_uuid)
                ->first();

            return ResponseHelper::success('Success', ['data' => $single_video]);
        } catch (\Exception $exception) {
            DB::rollBack();
            return ResponseHelper::error('Bir hata oluştu', [$exception->getMessage()]);
        }
    }

    public function update(VideoGalleryUpdateRequest $request): JsonResponse
    {
        DB::beginTransaction();
        $attributes = collect($request->validated());
        $single_video_uuid = $attributes->get('uuid');
        $attributes->forget('uuid');
        try {
            $single_video = VideoGallery::query()
                ->where('uuid', $single_video_uuid)
                ->first();

            $single_video->update($attributes->toArray());
            DB::commit();
            return ResponseHelper::success('Video Galeri Güncelleme işlemi başarılı bir şekilde gerçekleştirildi.');
        } catch (\Exception $exception) {
            DB::rollBack();
            return ResponseHelper::error('Bir hata oluştu', [$exception->getMessage()]);
        }
    }
}

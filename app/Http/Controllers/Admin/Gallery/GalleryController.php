<?php

namespace App\Http\Controllers\Admin\Gallery;

use App\Enum\Gallery\GalleryTypeEnum;
use App\Helper\ImageHelper;
use App\Helpers\Response\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Gallery\GalleryStoreRequest;
use App\Http\Requests\Admin\Gallery\GalleryUpdateRequest;
use App\Models\Gallery;
use App\Models\MorphImage;
use App\Models\Newsletter;
use App\Models\NewsletterPublicationStatus;
use App\Service\Gallery\GalleryService;
use App\Service\Seo\SeoService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class GalleryController extends Controller
{
    protected GalleryService $gallery_service;
    protected SeoService $seo_service;

    private const PATH = 'admin.gallery.';
    public function __construct(GalleryService $gallery_service, SeoService $seo_service)
    {
        $this->gallery_service = $gallery_service;
        $this->seo_service = $seo_service;
    }

    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $galleries = $this->gallery_service->getAllData();
        return view(self::PATH.'index', compact('galleries'));
    }

    public function store(GalleryStoreRequest $request): JsonResponse
    {
        $attributes = collect($request->validated());
        $attributes->put('created_by_user_id', auth()->id());
        $attributes->put('uuid', Str::uuid());
        $attributes->put('order', Gallery::query()->max('order') + 1);

        $file = $attributes->get('file');
        $attributes->forget('file');

        DB::beginTransaction();
        try {
            /** @var Gallery $gallery_create */
            $gallery_create = Gallery::query()
                ->create($attributes->toArray());

            if ($file) {
                $gallery_main_file =  ImageHelper::uploadImage($file);

                $gallery_create->image()->create($gallery_main_file);
            }
            $this->seo_service->generateSeoData($gallery_create);

            DB::commit();
            return ResponseHelper::success('Galeri ekleme işlemi başarılı bir şekilde gerçekleştirildi.');
        } catch (\Throwable $exception) {
            DB::rollBack();
            return ResponseHelper::error('Bir hata oluştu', [$exception->getMessage()]);
        }
    }

    public function edit(string $gallery_uuid): JsonResponse
    {
        try {
            /** @var Gallery $gallery */
            $gallery = Gallery::query()
                ->select('galleries.title', 'galleries.description', 'galleries.is_active', 'galleries.type', 'galleries.uuid as gallery_uuid')
                ->addSelect('morph_images.path')
                ->join('morph_images', 'morph_images.imageable_id', '=', 'galleries.id')
                ->where('galleries.uuid', $gallery_uuid)
                ->first();

            return ResponseHelper::success('Galeri ekleme işlemi başarılı bir şekilde gerçekleştirildi.', $gallery);
        } catch (\Throwable $exception) {
            return ResponseHelper::error('Bir hata oluştu', [$exception->getMessage()]);
        }
    }

    public function update(GalleryUpdateRequest $request): JsonResponse
    {
        $attributes = collect($request->validated());

        $gallery_uuid = $attributes->get('gallery_uuid');
        $attributes->forget('gallery_uuid');

        $file = $attributes->get('file_update');
        $attributes->forget('file_update');
        DB::beginTransaction();
        try {

            $gallery = Gallery::query()
                ->where('uuid', $gallery_uuid)
                ->first();
            $gallery->update($attributes->toArray());

            if ($file) {

                $image_exists = MorphImage::gallery()
                    ->where('imageable_id', $gallery->id)
                    ->first();

                if (!is_null($image_exists)) {
                    $gallery_update = ImageHelper::updateImage($file, $image_exists?->path);
                    $image_exists->update($gallery_update);
                } else {
                    $gallery_image_create = ImageHelper::uploadImage($file);
                    $gallery->image()->create($gallery_image_create);
                }
            }
            $this->seo_service->generateSeoData($gallery);

            DB::commit();
            return ResponseHelper::success('Galeri ekleme işlemi başarılı bir şekilde gerçekleştirildi.');
        } catch (\Throwable $exception) {
            DB::rollBack();
            return ResponseHelper::error('Bir hata oluştu', [$exception->getMessage()]);
        }
    }

    public function show($gallery_uuid)
    {
        try {
            /** @var Gallery $gallery */
            $gallery = Gallery::query()
                ->where('uuid', $gallery_uuid)
                ->first();


            if ($gallery->type === GalleryTypeEnum::IMAGE) {
                $gallery = $gallery->load('videoGalleries');
                $gallery_view = self::PATH . 'image.index';
            } else if ($gallery->type === GalleryTypeEnum::VIDEO) {
                $gallery = $gallery->load('videoGalleries');
                $gallery_view = self::PATH . 'video.index';
            } else {
                Log::error('GalleryController ımage type null geldi.');
                abort(404);
            }

            return view($gallery_view, compact('gallery'));

        } catch (\Exception $exception) {
            Log::error('GalleryController show methodunda bir hata ile karşılaşıldı: ', ['errors' => $exception->getMessage()]);
            abort(404);
        }
    }
}

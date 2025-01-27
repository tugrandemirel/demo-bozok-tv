<?php

namespace App\Http\Controllers\Admin\Newsletter;

use App\Enum\Newsletter\NewsletterGeneralEnum;
use App\Helper\ImageHelper;
use App\Helpers\Response\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Newsletter\NewsletterFilterRequest;
use App\Http\Requests\Admin\Newsletter\NewsletterPublicationStatusChangeRequest;
use App\Http\Requests\Admin\Newsletter\NewsletterStoreRequest;
use App\Http\Requests\Admin\Newsletter\NewsletterUpdateRequest;
use App\Models\MainHeadline;
use App\Models\MorphImage;
use App\Models\Newsletter;
use App\Models\NewsletterPublicationStatus;
use App\Models\SeoSetting;
use App\Models\Tag;
use App\Service\Newsletter\NewsletterService;
use App\Service\Seo\SeoService;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class NewsletterController extends Controller
{
    private const PATH = 'admin.newsletter.';
    protected NewsletterService $newsletterService;
    protected SeoService $seo_service;
    public function __construct(NewsletterService $newsletterService, SeoService $seo_service)
    {
        $this->newsletterService = $newsletterService;
        $this->seo_service = $seo_service;
    }

    public function index(NewsletterFilterRequest $request)
    {
        if ($request->ajax()) {
            return $this->newsletterService->getAllDataForDatatable($request);
        }
        return view(self::PATH . 'index');
    }

    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        /** @var NewsletterPublicationStatus $publication_status */
        $publication_statuses = NewsletterPublicationStatus::query()
            ->select('uuid', 'name')
            ->get();

        return view('admin.newsletter.create.create', compact('publication_statuses'));
    }

    public function store(NewsletterStoreRequest $request): JsonResponse
    {
        $attributes = collect($request->validated());
        $attributes->put('created_by_user_id', auth()->id());
        $attributes->put('uuid', Str::uuid());
        $attributes->put('publish_date', !is_null($attributes->get('publish_date')) ? Carbon::createFromFormat('d/m/Y H:i', $attributes->get('publish_date'))->toDateTimeString() : null);

        $seo = $attributes->get('seo');
        $attributes->forget('seo');
        $seo['created_by_user_id'] = auth()->id();
        $seo['uuid'] = Str::uuid();

        $tags = $attributes->get('tags');
        $attributes->forget('tags');

        $cover_image = $attributes->get('cover_image');
        $attributes->forget('cover_image');

        $inside_image = $attributes->get('inside_image');
        $attributes->forget('inside_image');

        $five_cuff_image = $attributes->get('five_cuff_image');
        $attributes->forget('five_cuff_image');
        DB::beginTransaction();
        try {
            /** @var Newsletter $newsletter */
            $newsletter = Newsletter::query()
                ->create($attributes->toArray());

            if ($attributes->get("is_five_"))

            foreach ($tags as $tag) {
                /** @var Tag $create_tag */
                $create_tag = Tag::query()
                    ->firstOrCreate(
                        ['name' => $tag],
                        [
                            'uuid' => Str::uuid(),
                            'created_by_user_id' => auth()->id()
                        ]);

                $newsletter->newsletterTags()
                    ->create([
                        'tag_id' => $create_tag?->id
                    ]);
            }

            if ($cover_image) {
                $cover_image_create = ImageHelper::uploadImage($cover_image);
                $cover_image_create['image_type'] = 'COVER';

                $newsletter->images()->create($cover_image_create);
            }

            if ($inside_image) {
                $inside_image_create = ImageHelper::uploadImage($inside_image);
                $inside_image_create['image_type'] = 'INSIDE';

                $newsletter->images()->create($inside_image_create);
            }

            if ($attributes->get('is_five_cuff') === NewsletterGeneralEnum::ON->value) {
                if (!$five_cuff_image) {
                    return ResponseHelper::error('Lütfen Beşli Manşet görselini ekleyiniz.');
                } else {
                    $five_cuff_image_create = ImageHelper::uploadImage($five_cuff_image);
                    $five_cuff_image_create['image_type'] = 'FEATURED';

                    $newsletter->images()->create($five_cuff_image_create);
                }
            }

            if ($attributes->get('is_seo') === NewsletterGeneralEnum::ON->value ) {
                $this->seo_service->generateSeoData($newsletter);
            } else {
                $seo['uuid'] = Str::uuid();
                $seo['seoable_id'] = $newsletter->id;
                $seo['seoable_type'] = Newsletter::class;

                SeoSetting::query()
                    ->create($seo);
            }

            if ($attributes->get('is_main_headline') === NewsletterGeneralEnum::ON->value) {
                /** @var MainHeadline $main_headlines */
                $main_headline = New MainHeadline();
                $main_headline->headlineable()->associate($newsletter);
                $main_headline->save();
            }

            if ($attributes->get('is_outstanding') === NewsletterGeneralEnum::ON->value) {
                $newsletter->outstandings()->create([]);
            }

            if ($attributes->get('is_last_minute') === NewsletterGeneralEnum::ON->value) {
                $newsletter->lastMinutes()->create([]);
            }

            if ($attributes->get('is_today_headline') === NewsletterGeneralEnum::ON->value) {
                $newsletter->todayHeadline()->create([]);
            }

            DB::commit();
            return ResponseHelper::success('Haber kaydetme işlemi başarılı bir şekilde gerçekleştirildi.');
        } catch (\Throwable $exception) {
            DB::rollBack();
            return ResponseHelper::error('Bir hata oluştu', [$exception->getMessage()]);
        }

    }

    public function show(string $newsletter_uuid)
    {
        try {
            /** @var NewsletterPublicationStatus $publication_statuses */
            $publication_statuses = NewsletterPublicationStatus::query()
                ->get();

            /** @var Newsletter $newsletter */
            $newsletter = Newsletter::query()
                ->select('newsletters.*', 'newsletter_publication_statuses.code')
                ->addSelect(DB::raw('CASE WHEN newsletter_five_cuffs.id IS NOT NULL THEN true ELSE false END as has_five_cuff'))
                ->addSelect(DB::raw('CASE WHEN newsletter_last_minutes.id IS NOT NULL THEN true ELSE false END as has_last_minute'))
                ->addSelect(DB::raw('CASE WHEN newsletter_outstandings.id IS NOT NULL THEN true ELSE false END as has_out_standing'))
                ->addSelect(DB::raw('CASE WHEN newsletter_today_headlines.id IS NOT NULL THEN true ELSE false END as has_today_headline'))
                ->addSelect(DB::raw("case WHEN main_headlines.id IS NOT NULL THEN true ELSE false END as has_main_headline"))
                ->join('newsletter_publication_statuses', 'newsletter_publication_statuses.id', '=', 'newsletters.newsletter_publication_status_id')
                ->leftJoin("newsletter_five_cuffs", "newsletters.id", "=", "newsletter_five_cuffs.newsletter_id")
                ->leftJoin("newsletter_last_minutes", "newsletters.id", "=", "newsletter_last_minutes.newsletter_id")
                ->leftJoin("newsletter_outstandings", "newsletters.id", "=", "newsletter_outstandings.newsletter_id")
                ->leftJoin("newsletter_today_headlines", "newsletters.id", "=", "newsletter_today_headlines.newsletter_id")
                ->leftJoin("main_headlines", function ($join) {
                    $join->on("newsletters.id", "=", "main_headlines.headlineable_id")
                        ->where("main_headlines.headlineable_type", Newsletter::class);
                })
                ->where('newsletters.uuid', $newsletter_uuid)
                ->first();

            /** @var MorphImage $images */
            $images = MorphImage::query()
                ->where('imageable_id', $newsletter->id)
                ->where('imageable_type', Newsletter::class)
                ->get();
            $newsletter['images'] = $images;

            /** @var SeoSetting $seo */
            $seo = SeoSetting::query()
                ->where('seoable_id', $newsletter->id)
                ->where('seoable_type', Newsletter::class)
                ->first();
            $newsletter['seo'] = $seo;

            /** @var Tag $tags */
            $tags = DB::table('newsletters')
                ->join('newsletter_tags', 'newsletters.id', '=', 'newsletter_tags.newsletter_id')
                ->join('tags', 'newsletter_tags.tag_id', '=', 'tags.id')
                ->where('newsletters.id', $newsletter->id)
                ->select('tags.*')
                ->get();
            $newsletter['tags'] = $tags;

            return view(self::PATH . 'show.show', compact('publication_statuses', 'newsletter'));
        } catch (\Exception $exception) {
            Log::error('NewsletterController show methodunda bir hata ile karşılaşıldı: ', ['errors' => $exception->getMessage()]);
            abort(404);
        }
    }

    public function edit(string $newsletter_uuid)
    {
        try {
            /** @var NewsletterPublicationStatus $publication_statuses */
            $publication_statuses = NewsletterPublicationStatus::query()
                ->get();

            /** @var Newsletter $newsletter */
            $newsletter = Newsletter::query()
                ->select('newsletters.*', 'newsletter_publication_statuses.code')
                ->addSelect(DB::raw('CASE WHEN newsletter_five_cuffs.id IS NOT NULL THEN true ELSE false END as has_five_cuff'))
                ->addSelect(DB::raw('CASE WHEN newsletter_last_minutes.id IS NOT NULL THEN true ELSE false END as has_last_minute'))
                ->addSelect(DB::raw('CASE WHEN newsletter_outstandings.id IS NOT NULL THEN true ELSE false END as has_out_standing'))
                ->addSelect(DB::raw('CASE WHEN newsletter_today_headlines.id IS NOT NULL THEN true ELSE false END as has_today_headline'))
                ->addSelect(DB::raw("case WHEN main_headlines.id IS NOT NULL THEN true ELSE false END as has_main_headline"))
                ->join('newsletter_publication_statuses', 'newsletter_publication_statuses.id', '=', 'newsletters.newsletter_publication_status_id')
                ->leftJoin("newsletter_five_cuffs", "newsletters.id", "=", "newsletter_five_cuffs.newsletter_id")
                ->leftJoin("newsletter_last_minutes", "newsletters.id", "=", "newsletter_last_minutes.newsletter_id")
                ->leftJoin("newsletter_outstandings", "newsletters.id", "=", "newsletter_outstandings.newsletter_id")
                ->leftJoin("newsletter_today_headlines", "newsletters.id", "=", "newsletter_today_headlines.newsletter_id")
                ->leftJoin("main_headlines", function ($join) {
                    $join->on("newsletters.id", "=", "main_headlines.headlineable_id")
                        ->where("main_headlines.headlineable_type", Newsletter::class);
                })
                ->where('newsletters.uuid', $newsletter_uuid)
                ->first();

            /** @var MorphImage $cover_image */
            $cover_image = MorphImage::query()
                ->select('path', 'image_ext')
                ->where('imageable_id', $newsletter->id)
                ->cover()
                ->first();

            /** @var MorphImage $featured_image */
            $featured_image = MorphImage::query()
                ->where('imageable_id', $newsletter->id)
                ->featured()
                ->first();

            /** @var MorphImage $inside_image */
            $inside_image = MorphImage::query()
                ->where('imageable_id', $newsletter->id)
                ->inside()
                ->first();

            /** @var SeoSetting $seo */
            $seo = SeoSetting::query()
                ->where('seoable_id', $newsletter->id)
                ->where('seoable_type', Newsletter::class)
                ->first();
            $newsletter['seo'] = $seo;

            /** @var Tag $tags */
            $tags = DB::table('newsletters')
                ->join('newsletter_tags', 'newsletters.id', '=', 'newsletter_tags.newsletter_id')
                ->join('tags', 'newsletter_tags.tag_id', '=', 'tags.id')
                ->where('newsletters.id', $newsletter->id)
                ->select('tags.*') // Tag bilgilerini seçiyoruz
                ->get();
            $newsletter['tags'] = $tags;

            return view(self::PATH . 'edit.edit', compact('cover_image', 'inside_image', 'featured_image', 'publication_statuses', 'newsletter'));
        } catch (\Exception $exception) {
            Log::error('NewsletterController show methodunda bir hata ile karşılaşıldı: ', ['errors' => $exception->getMessage()]);
            abort(404);
        }
    }

    public function update(NewsletterUpdateRequest $request): JsonResponse
    {
        $attributes = collect($request->validated());
        $attributes->put('publish_date', !is_null($attributes->get('publish_date')) ? Carbon::createFromFormat('d/m/Y H:i', $attributes->get('publish_date'))->toDateTimeString() : null);
        $newsletter_id = $attributes->get('newsletter_id');
        $attributes->forget('newsletter_id');

        $attributes->forget('seo');
        $seo = $attributes->get('seo');
        $seo['created_by_user_id'] = auth()->id();
        $seo['uuid'] = Str::uuid();

        $tags = $attributes->get('tags');
        $attributes->forget('tags');

        $cover_image = $attributes->get('cover_image');
        $attributes->forget('cover_image');

        $inside_image = $attributes->get('inside_image');
        $attributes->forget('inside_image');

        $five_cuff_image = $attributes->get('five_cuff_image');
        $attributes->forget('five_cuff_image');

        DB::beginTransaction();
        try {

            /** @var Newsletter $newsletter */
            $newsletter = Newsletter::query()
                ->where('id', $newsletter_id)
                ->first();

            $newsletter->update($attributes->toArray());

            if ($cover_image) {
                $cover_image_exists = MorphImage::cover()
                    ->where('imageable_id', $newsletter?->id)
                    ->first();

                if (!is_null($cover_image_exists)) {
                    $cover_image_update = ImageHelper::updateImage($cover_image, $cover_image_exists?->path);
                    $cover_image_exists->update($cover_image_update);
                } else {
                    $cover_image_create = ImageHelper::uploadImage($cover_image);

                    $cover_image_create['image_type'] = 'COVER';
                    $newsletter->images()->create($cover_image_create);
                }
            }

            if ($inside_image) {
                $inside_image_exists = MorphImage::inside()
                    ->where('imageable_id', $newsletter?->id)
                    ->first();

                if (!is_null($inside_image_exists)) {
                    $inside_image_update = ImageHelper::updateImage($inside_image, $inside_image_exists?->path);
                    $inside_image_exists->update($inside_image_update);
                } else {
                    $inside_image_create = ImageHelper::uploadImage($inside_image);
                    $inside_image_create['image_type'] = 'INSIDE';

                    $newsletter->images()->create($inside_image_create);
                }
            }

            if ($attributes->get('is_five_cuff') === NewsletterGeneralEnum::ON->value) {
                if (!is_null($five_cuff_image)) {
                    $featured_image_exists = MorphImage::featured()
                        ->where('imageable_id', $newsletter?->id)
                        ->first();
                    if (!is_null($featured_image_exists)) {
                        $featured_image_update = ImageHelper::updateImage($five_cuff_image, $featured_image_exists->path);
                        $featured_image_exists->update($featured_image_update);
                    } else {
                        $featured_image_create = ImageHelper::uploadImage($five_cuff_image);
                        $featured_image_create['image_type'] = 'FEATURED';

                        $newsletter->images()->create($featured_image_create);
                    }
                }
            } else {
                $featured_image_exists = MorphImage::featured()
                    ->where('imageable_id', $newsletter?->id)
                    ->first();
                if ($featured_image_exists) {
                    ImageHelper::deleteImage($featured_image_exists?->path);
                }
            }

            if ($attributes->get('is_seo') === NewsletterGeneralEnum::ON->value ) {
                $this->seo_service->generateSeoData($newsletter);
            } else {
                $seo_setting_is_exists = SeoSetting::newsletter()
                    ->where('seoable_id', $newsletter?->id)
                    ->first();
                if ($seo_setting_is_exists) {
                    $seo_setting_is_exists->update($seo);
                } else {
                    $seo['uuid'] = Str::uuid();
                    $seo['seoable_id'] = $newsletter->id;
                    $seo['seoable_type'] = Newsletter::class;
                    SeoSetting::query()
                        ->create($seo);
                }
            }

            $main_headline = $newsletter->mainHeadlines()->first();

            if ($attributes->get('is_main_headline') === NewsletterGeneralEnum::OFF->value) {
                if ($main_headline) {
                    $main_headline->delete();
                }
            } else {
                if (!$main_headline) {
                    $main_headline = New MainHeadline();
                    $main_headline->headlineable()->associate($newsletter);
                    $main_headline->save();
                }
            }

            $outstanding = $newsletter->outstandings()->first();
            if ($attributes->get('is_outstanding') === NewsletterGeneralEnum::ON->value) {
                if (!$outstanding) {
                    $newsletter->outstandings()->create([]);
                }
            } else {
                $outstanding?->delete();
            }

            $last_minute = $newsletter->lastMinutes()->first();
            if ($attributes->get('is_last_minute') === NewsletterGeneralEnum::ON->value) {
                if (!$last_minute) {
                    $newsletter->lastMinutes()->create([]);
                }
            } else {
                $last_minute?->delete();
            }

            $today_headline = $newsletter->todayHeadline()->first();
            if ($attributes->get('is_today_headline') === NewsletterGeneralEnum::ON->value) {
                if (!$today_headline) {
                    $newsletter->todayHeadline()->create([]);
                }
            } else {
                $today_headline?->delete();
            }

            DB::commit();
            return ResponseHelper::success('Haber güncelleme işlemi başarılı bir şekilde gerçekleştirildi.');
        } catch (\Throwable $exception) {
            return ResponseHelper::error('Bir hata oluştu', [$exception->getMessage()]);
        }
    }

    public function changePublicationStatus(NewsletterPublicationStatusChangeRequest $request): JsonResponse
    {
        $attributes = collect($request->validated());

        DB::beginTransaction();
        try {
            Newsletter::query()
                ->where('id', $attributes->get('newsletter'))
                ->update([
                    'newsletter_publication_status_id' => $attributes->get('newsletter_publication_status_id')
                ]);

            DB::commit();

            return ResponseHelper::success('Haber durumu değiştirme işlemi başarılı bir şekilde gerçekleştirildi.');
        } catch (\Exception $exception) {
            DB::rollBack();
            return ResponseHelper::error('NewsletterController changePublicationStatus Bir hata oluştu', [$exception->getMessage()]);
        }
    }
}

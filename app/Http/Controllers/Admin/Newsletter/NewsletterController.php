<?php

namespace App\Http\Controllers\Admin\Newsletter;

use App\Enum\Category\CategoryIsActiveEnum;
use App\Enum\Newsletter\NewsletterGeneralEnum;
use App\Enum\NewsletterSource\NewsletterSourceIsActiveEnum;
use App\Helper\ImageHelper;
use App\Helpers\Response\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Newsletter\NewsletterFilterRequest;
use App\Http\Requests\Admin\Newsletter\NewsletterPublicationStatusChangeRequest;
use App\Http\Requests\Admin\Newsletter\NewsletterStoreRequest;
use App\Models\Category;
use App\Models\MorphImage;
use App\Models\Newsletter;
use App\Models\NewsletterPublicationStatus;
use App\Models\NewsletterSource;
use App\Models\SeoSetting;
use App\Models\Tag;
use App\Service\Newsletter\NewsletterService;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class NewsletterController extends Controller
{
    private const PATH = 'admin.newsletter.';
    protected $newsletterService;

    public function __construct(NewsletterService $newsletterService)
    {
        $this->newsletterService = $newsletterService;
    }

    public function index(NewsletterFilterRequest $request)
    {
        if ($request->ajax()) {
            return $this->newsletterService->getAllDataForDatatable($request);
        }
        return view(self::PATH.'index');
    }

    public function create()
    {
        /** @var Category $categories */
        $categories = Category::query()
            ->select('uuid', 'name')
            ->where('is_active', CategoryIsActiveEnum::ACTIVE)
            ->orderBy('order')
            ->get();

        /** @var NewsletterPublicationStatus $publication_status */
        $publication_statuses = NewsletterPublicationStatus::query()
            ->select('uuid', 'name')
            ->get();

        /** @var NewsletterSource $newsletter_sources */
        $newsletter_sources = NewsletterSource::query()
            ->select('uuid', 'name')
            ->where('is_active', NewsletterSourceIsActiveEnum::ACTIVE)
            ->orderBy('order')
            ->get();

        return view('admin.newsletter.create.create', compact('categories', 'publication_statuses', 'newsletter_sources'));
    }

    public function store(NewsletterStoreRequest $request): JsonResponse
    {
        $attributes = collect($request->validated());
        $attributes->put('created_by_user_id', auth()->id());
        $attributes->put('uuid', Str::uuid());
        $attributes->put('publish_date', !is_null($attributes->get('publish_date')) ? Carbon::createFromFormat('d/m/Y H:i', $attributes->get('publish_date'))->toDateTimeString() : null);

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
                ->create($attributes->toArray());

            $seo['seoable_id'] = $newsletter->id;
            $seo['seoable_type'] = Newsletter::class;

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
                $cover_image_create = ImageHelper::uploadImage($cover_image, $newsletter->id);
                $cover_image_create['image_type'] = 'COVER';
//                $cover_image_create['imageable_id'] = $newsletter->id;
//                $cover_image_create['imageable_type'] = Newsletter::class;

                $newsletter->images()->create($cover_image_create);
            }

            if ($inside_image) {
                $inside_image_create = ImageHelper::uploadImage($inside_image, $newsletter->id);
                $inside_image_create['image_type'] = 'INSIDE';
//                $inside_image_create['imageable_id'] = $newsletter->id;
//                $inside_image_create['imageable_type'] = Newsletter::class;

                $newsletter->images()->create($inside_image_create);
            }

            if ($attributes->get('is_five_cuff') === NewsletterGeneralEnum::ON->value) {
                if (!$five_cuff_image) {
                    return ResponseHelper::error('Lütfen Beşli Manşet görselini ekleyiniz.');
                } else {
                    $five_cuff_image_create = ImageHelper::uploadImage($five_cuff_image, $newsletter->id);
                    $five_cuff_image_create['image_type'] = 'FEATURED';
//                    $five_cuff_image_create['imageable_id'] = $newsletter->id;
//                    $five_cuff_image_create['imageable_type'] = Newsletter::class;

                    $newsletter->images()->create($five_cuff_image_create);
                }
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

            /** @var Category $categories */
            $categories = Category::query()
                ->where('is_active', CategoryIsActiveEnum::ACTIVE)
                ->get();

            /** @var Newsletter $newsletter */
            $newsletter = Newsletter::query()
                ->select('newsletters.*', 'newsletter_publication_statuses.code')
                ->join('newsletter_publication_statuses', 'newsletter_publication_statuses.id', '=', 'newsletters.newsletter_publication_status_id')
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
                ->select('tags.*') // Tag bilgilerini seçiyoruz
                ->get();

            $newsletter['tags'] = $tags;



            return view(self::PATH.'show.show', compact('publication_statuses', 'newsletter', 'categories'));
        } catch (\Exception $exception) {
            dd($exception->getMessage());
            Log::error('NewsletterController show methodunda bir hata ile karşılaşıldı: ', ['errors' => $exception->getMessage()]);
            abort(404);
        }
    }

    public function edit(string $newsletter_uuid)
    {

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

<?php

namespace App\Http\Controllers\Api\V1;

use App\Enum\Category\CategoryIsActiveEnum;
use App\Helpers\Response\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Service\MainHeadline\MainHeadlineService;
use Illuminate\Http\JsonResponse;
use Mockery\Exception;

class MainHeadlineApiController extends Controller
{
    private MainHeadlineService $main_headline_service;
    public function __construct(MainHeadlineService $main_headline_service)
    {
        $this->main_headline_service = $main_headline_service;
    }

    public function index(): JsonResponse
    {
        try {
            $main_headlines = $this->main_headline_service->getMainHeadlines();
            return ResponseHelper::success("Ana Manşet Başarılı bir şekilde çekildi.", ['data' => $main_headlines], 200);
        } catch (Exception $exception) {
            return ResponseHelper::error("Bir hata oluştu.", [$exception->getMessage()]);
        }
    }

    /**
     * Display a listing of the resource.
     */
    /*public function index()
    {
        try {

            $newsletter_publication_active = NewsletterPublicationStatus::query()
                ->select('code')
                ->onTheAir()
                ->first();

            $main_headlines = MainHeadline::query()
                ->select("main_headlines.order", "main_headlines.headlineable_type", "main_headlines.id as main_headline_id")
                ->addSelect("newsletters.title", "newsletters.slug")
                ->addSelect("morph_images.path as newsletter_image_path")
                ->addSelect("categories.name as category_name")
                ->addSelect("ads.url as ad_url")
                ->addSelect("ad_morph_images.path as ad_image_path")
                ->leftJoin("newsletters", function ($join) {
                    $join->on('main_headlines.headlineable_id', '=', 'newsletters.id')
                        ->where('main_headlines.headlineable_type', Newsletter::class);
                })
                ->leftJoin('morph_images', function ($join) {
                    $join->on('morph_images.imageable_id', '=', 'newsletters.id')
                        ->where('morph_images.imageable_type', '=', Newsletter::class)
                        ->where('morph_images.image_type',  'COVER');
                })
                ->leftJoin("newsletter_publication_statuses", function ($join) use ($newsletter_publication_active) {
                    $join->on("newsletter_publication_statuses.id", "=", "newsletters.newsletter_publication_status_id")
                        ->where('newsletter_publication_statuses.code', $newsletter_publication_active?->code);
                })
                ->leftJoin("categories", function ($join) {
                    $join->on("categories.id", "=", "newsletters.category_id")
                        ->where('categories.is_active', CategoryIsActiveEnum::ACTIVE);
                })
                ->leftJoin("ads", function ($join) {
                    $join->on('main_headlines.headlineable_id', '=', 'ads.id')
                        ->where('main_headlines.headlineable_type', Ads::class);
                })
                ->leftJoin('morph_images as ad_morph_images', function ($join) {
                    $join->on('ad_morph_images.imageable_id', '=', 'ads.id')
                        ->where('ad_morph_images.imageable_type', '=', Ads::class);
                })
                ->orderBy('main_headlines.order', 'asc')
                ->limit(10)
                ->get();

            return ResponseHelper::success("Ana Manşet Başarılı bir şekilde çekildi.", ['data' => $main_headlines], 200);
        } catch (\Exception $exception) {
            return ResponseHelper::error("Bir hata oluştu.", [$exception->getMessage()]);
        }
    }*/
}

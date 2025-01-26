<?php

namespace App\Http\Controllers\Admin\Newsletter;

use App\Helpers\Custom\CustomHelper;
use App\Http\Controllers\Controller;
use App\Models\Ads;
use App\Models\MainHeadline;
use App\Models\Newsletter;
use App\Models\NewsletterPublicationStatus;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use PHPUnit\Exception;

class NewsletterMainHeadlineController extends Controller
{
    private const PATH = 'admin.newsletter.main-headline.';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /** @var LengthAwarePaginator $main_headlines */
        $main_headlines = MainHeadline::query()
            ->select("main_headlines.order", "main_headlines.created_at", "main_headlines.headlineable_type", "main_headlines.uuid as main_headline_uuid")
            ->addSelect("newsletters.title", "newsletters.spot")
            ->addSelect("newsletter_publication_statuses.name as newsletter_status_name", "newsletter_publication_statuses.code as newsletter_status_code")
            ->addSelect("morph_images.path as newsletter_image_path")
            ->addSelect("categories.name as category_name")
            ->addSelect("newsletter_sources.name as newsletter_source_name")
            ->addSelect("ads.is_active", "ads.start_date as ads_start_date", "ads.end_date as ads_end_date")
            ->addSelect("placements.name as ad_placement_name")
            ->addSelect("ad_types.name as ad_type_name", "ad_types.code as ad_type_code")
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
            ->leftJoin("newsletter_publication_statuses", "newsletter_publication_statuses.id", "=", "newsletters.newsletter_publication_status_id")
            ->leftJoin("categories", "categories.id", "=", "newsletters.category_id")
            ->leftJoin("newsletter_sources", "newsletter_sources.id", "=", "newsletters.newsletter_source_id")
            ->leftJoin("ads", function ($join) {
                $join->on('main_headlines.headlineable_id', '=', 'ads.id')
                    ->where('main_headlines.headlineable_type', Ads::class);
            })
            ->leftJoin('morph_images as ad_morph_images', function ($join) {
                $join->on('ad_morph_images.imageable_id', '=', 'ads.id')
                    ->where('ad_morph_images.imageable_type', '=', Ads::class);
            })
            ->leftJoin("placements", "placements.id", "=", "ads.placement_id")
            ->leftJoin("ad_types", "ad_types.id", "=", "ads.ad_type_id")
            ->orderBy('main_headlines.order', 'desc')
           ->get();

//            ->paginate(20);

        return view(self::PATH . 'index', compact("main_headlines"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try {
            $uuids = collect($request->input('uuids'))->toArray();

            foreach ($uuids as $order => $uuid) {
                MainHeadline::query()
                    ->where('uuid', $uuid)
                    ->update(['order' => $order + 1]);
            }

            return response()->json(['message' => 'Sıralama başarıyla güncellendi.']);
        } catch (Exception $exception) {
            dd($exception->getMessage());
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

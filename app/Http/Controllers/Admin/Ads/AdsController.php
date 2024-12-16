<?php

namespace App\Http\Controllers\Admin\Ads;

use App\Helper\ImageHelper;
use App\Helpers\Response\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Ads\AdsStoreRequest;
use App\Models\Ads;
use App\Models\AdType;
use App\Models\MainHeadline;
use App\Models\Placement;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AdsController extends Controller
{
    private const PATH = 'admin.ads.';

    public function index(): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        /** @var LengthAwarePaginator $ads */
        $ads = Ads::query()
            ->select('ads.*')
            ->addSelect(DB::raw("MAX(morph_images.path) as path"))
            ->addSelect(DB::raw("MAX(placements.name) as placement_name"))
            ->addSelect(DB::raw("MAX(ad_types.name) as ad_type_name"))
            ->addSelect(DB::raw("MAX(ad_types.code) as ad_type_code"))
            ->leftJoin('morph_images', function ($join) {
                $join->on("morph_images.imageable_id", "=", "ads.id")
                    ->where("morph_images.imageable_type", "=", Ads::class);
            })
            ->join("placements", "placements.id", "=", "ads.placement_id")
            ->join("ad_types", "ad_types.id", "=", "ads.ad_type_id")
            ->whereNull("ads.deleted_at")
            ->groupBy('ads.id')
            ->paginate(10);

        return view(self::PATH.'index', compact("ads"));
    }

    public function create(): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        return view(self::PATH.'create');
    }

    public function store(AdsStoreRequest $request)
    {
        $attributes = collect($request->validated());
        $image = $attributes->get('file');
        $attributes->forget('file');

        DB::beginTransaction();
        try {
            $attributes->put('created_by_user_id', auth()->id());
            $attributes->put('uuid', Str::uuid());

            /** @var AdType $google_ads */
            $google_ads = AdType::query()
                ->select('code')
                ->google()
                ->first();

            /** @var AdType $special_ads */
            $special_ads = AdType::query()
                ->select('code')
                ->special()
                ->first();

            /** @var Ads $ads */
            $ads = Ads::query()
                ->create($attributes->toArray());

            if ($request->input('ad_type') === $special_ads->code) {
                if (!$request->file) {
                    return ResponseHelper::error('Bir hata oluştu', ['Lütfen Resim seçimi yapınız.'], 422);
                } else {
                    $image = ImageHelper::uploadImage($image);
                    $ads->image()->create($image);
                }
            }

            /** @var Placement $placement_main_headline */
            $placement_main_headline = Placement::query()
                ->select('code')
                ->mainHeadline()
                ->first();

            if ($placement_main_headline->code === $request->input('placement')) {
                /** @var MainHeadline $main_headlines */
                $main_headline = New MainHeadline();
                $main_headline->headlineable()->associate($ads);
                $main_headline->save();
            }

            DB::commit();
            return ResponseHelper::success('Reklam ekleme işlemi başarılı bir şekilde gerçekleştirildi.');
        } catch (\Exception $exception) {
            DB::rollBack();
            return ResponseHelper::error('Bir hata oluştu', [$exception->getMessage()]);
        }
    }
}

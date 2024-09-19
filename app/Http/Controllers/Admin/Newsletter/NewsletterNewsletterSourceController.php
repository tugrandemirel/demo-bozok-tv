<?php

namespace App\Http\Controllers\Admin\Newsletter;

use App\Enum\NewsletterSource\NewsletterSourceIsActiveEnum;
use App\Helpers\Response\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Newsletter\NewsletterSource\NewsletterSourceStoreRequest;
use App\Models\NewsletterSource;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class NewsletterNewsletterSourceController extends Controller
{
    public function index()
    {
        try {
            $newsletter_source = NewsletterSource::query()
                ->select('uuid', 'name')
                ->where('is_active', NewsletterSourceIsActiveEnum::ACTIVE)
                ->orderBy('order')
                ->get();

            return ResponseHelper::success('Veri çekme işlemi başarılı bir şekilde gerçekleşti', ['data' => $newsletter_source]);
        } catch (\Exception $exception) {
            return ResponseHelper::error('NewsletterNewsletterSourceController > index: bir hata oluştu', [$exception->getMessage()]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NewsletterSourceStoreRequest $request): JsonResponse
    {
        $attributes = collect($request->validated());
        $attributes->put('uuid', Str::uuid());
        $attributes->put('created_by_user_id', auth()->id());

        DB::beginTransaction();
        try {
            NewsletterSource::query()
                ->create($attributes->toArray());

            DB::commit();

            return ResponseHelper::success('Haber Kaynağı kaydetme işlemi başarılı bir şekilde gerçekleştirildi.');
        } catch (\Throwable $exception) {
            DB::rollBack();
            return ResponseHelper::error('NewsletterNewsletterSourceController > store: Bir hata oluştu', [$exception->getMessage()]);
        }
    }
}

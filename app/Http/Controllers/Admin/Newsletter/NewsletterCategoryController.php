<?php

namespace App\Http\Controllers\Admin\Newsletter;

use App\Enum\Category\CategoryIsActiveEnum;
use App\Helper\Response\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Newsletter\Category\CategoryStoreRequest;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class NewsletterCategoryController extends Controller
{
    public function index()
    {
        try {
            $categories = Category::query()
                ->select('uuid', 'name')
                ->where('is_active', CategoryIsActiveEnum::ACTIVE)
                ->orderBy('order')
                ->get();

            return ResponseHelper::success('Veri çekme işlemi başarılı bir şekilde gerçekleşti', ['data' => $categories]);
        } catch (\Exception $exception) {
            return ResponseHelper::error('Bir hata oluştu', [$exception->getMessage()]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryStoreRequest $request): JsonResponse
    {
        $attributes = collect($request->validated());
        $attributes->put('uuid', Str::uuid());
        $attributes->put('created_by_user_id', auth()->id());

        DB::beginTransaction();
        try {
            Category::query()
                ->create($attributes->toArray());

            DB::commit();

            return ResponseHelper::success('Kategori kaydetme işlemi başarılı bir şekilde gerçekleştirildi.');
        } catch (\Throwable $exception) {
            DB::rollBack();
            return ResponseHelper::error('Bir hata oluştu', [$exception->getMessage()]);
        }
    }
}

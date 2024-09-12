<?php

namespace App\Http\Controllers\Admin\Newsletter;

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
    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryStoreRequest $request): JsonResponse
    {
        $attributes = collect($request->validated());
        $attributes->put('uuid', Str::uuid());
        $attributes->put('created_user_by_id', auth()->id());

        DB::beginTransaction();
        try {
            Category::query()
                ->create($attributes->toArray());

            DB::commit();

            return ResponseHelper::success('Kategori kaydetme işlemi başarılı bir şekilde gerçekleştirildi.');
        } catch (\Throwable $exception) {
            DB::rollBack();
            return ResponseHelper::exception($exception);
        }
    }
}

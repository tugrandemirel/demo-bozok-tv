<?php

namespace App\Http\Controllers\Admin\Newsleter;

use App\Helpers\Response\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Newsletter\Tag\TagStoreRequest;
use App\Models\Tag;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class NewsletterTagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $query = $request->input('q');

            $tags = [];

            // Sorgu sonucunu chunk'lara ayırarak getir
            Tag::query()
                ->where('name', 'LIKE', "%{$query}%")
                ->chunk(100, function ($chunk) use (&$tags) {
                    foreach ($chunk as $tag) {
                        $tags[] = [
                            'id' => $tag->id,
                            'name' => $tag->name
                        ];
                    }
                });

            return ResponseHelper::success('Etiket işlemi başarılı bir şekilde gerçekleştirildi.', $tags);
        } catch (\Throwable $exception) {
            DB::rollBack();
            return ResponseHelper::error('Bir hata oluştu', [$exception->getMessage()]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TagStoreRequest $request)
    {
        $attributes = collect($request->validated());
        $attributes->put('uuid', Str::uuid());
        $attributes->put('created_by_user_id', auth()->id());

        DB::beginTransaction();
        try {
            Tag::query()
                ->create($attributes->toArray());
            DB::commit();

            return ResponseHelper::success('Etiket işlemi başarılı bir şekilde gerçekleştirildi.');
        } catch (\Throwable $exception) {
            DB::rollBack();
            return ResponseHelper::error('Bir hata oluştu', [$exception->getMessage()]);
        }
    }
}

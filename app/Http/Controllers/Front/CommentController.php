<?php

namespace App\Http\Controllers\Front;

use App\Helpers\Response\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Front\Comment\CommentIndexRequest;
use App\Http\Requests\Front\Comment\CommentStoreRequest;
use App\Models\Category;
use App\Models\Comment;
use App\Models\CommentStatus;
use App\Models\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CommentController extends Controller
{
    public function index(CommentIndexRequest $request, string $category_slug)
    {
        $attributes = collect($request->validated());

        try {
            $category = Category::query()
                ->where('slug', $category_slug)
                ->first();

            /** @var Newsletter $newsletter */
            $newsletter = Newsletter::query()
                ->where("category_id", $category->id)
                ->where("uuid", $attributes->get("newsletter_uuid"))
                ->first();

            /** @var CommentStatus $comment_status_active */
            $comment_status_active = CommentStatus::query()
                ->select( "code")
                ->active()
                ->first();

            /** @var Comment $comments */
            $comments = Comment::query()
                ->where("commentable_type", Newsletter::class)
                ->where("commentable_id", $newsletter->id)
                ->whereRelation("status", "code", "=", $comment_status_active?->code)
                ->limit(5)
                ->orderBy("created_at", "desc")
                ->get();

            return ResponseHelper::success('Veri çekme işlemi başarılı bir şekilde gerçekleşti', ["data" => $comments]);
        } catch (\Exception $exception) {
            return ResponseHelper::error('Bir hata oluştu', [$exception->getMessage()]);
        }
    }


    public function store(CommentStoreRequest $request)
    {
        $attributes = collect($request->validated());
        $newsletter_uuid = $attributes->get("newsletter_uuid");
        DB::beginTransaction();
        try {
            $newsletter = Newsletter::query()
                ->where("uuid", $newsletter_uuid)
                ->first();

            $comment_status_passive = CommentStatus::query()
                ->select("id")
                ->passive()
                ->first();

            Comment::query()
                ->create([
                    "uuid" => Str::uuid(),
                    "commentable_type" => Newsletter::class,
                    "commentable_id" => $newsletter?->id,
                    "user_id" => auth()->id() ?? null,
                    "content" => $attributes->get("content"),
                    "guest_name" => $attributes->get("guest_name"),
                    "comment_status_id" => $comment_status_passive?->id,
                ]);

            DB::commit();
            return ResponseHelper::success('Veri çekme işlemi başarılı bir şekilde gerçekleşti');
        } catch (\Exception $exception) {
            DB::rollBack();
            return ResponseHelper::error('Bir hata oluştu', [$exception->getMessage()]);
        }
    }
}

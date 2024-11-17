<?php

namespace App\Service\Posts;

use App\Helpers\Response\ResponseHelper;
use App\Http\Requests\Author\Posts\PostFilterRequest;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Facades\DataTables;

class AuthorPostService
{
    public function getAllDataForDatatable(PostFilterRequest $request): JsonResponse
    {
        try {
            $user = auth()->user();

            $posts = Post::query()
                ->select('posts.created_at', 'posts.title as post_title', 'posts.order as post_order_no')
                ->addSelect('post_statuses.name as post_status_name', 'post_statuses.code as post_status_code')
                ->addSelect('morph_images.image_name', 'morph_images.path as image_path', 'morph_images.image_type')
                ->join('users', 'users.id', '=', 'posts.user_id')
                ->join('morph_images', function ($join) {
                    $join->on('morph_images.imageable_id', '=', 'posts.id')
                        ->where('morph_images.imageable_type',  Post::class);
                })

                ->join('post_statuses', 'post_statuses.id', '=', 'posts.post_status_id')
                ->where("posts.user_id", $user->id)
                ->orderByDesc('posts.order');

            // DataTables çıktısını JSON olarak döndür
            return DataTables::of($posts)->toJson();

        } catch (\Exception $exception) {
            return ResponseHelper::error('Bir hata oluştu', [$exception->getMessage()]);
        }
    }
}

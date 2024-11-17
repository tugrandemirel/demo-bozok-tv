<?php

namespace App\Http\Controllers\Admin\Posts;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Posts\PostFilterRequest;
use App\Models\Post;
use App\Service\Posts\AuthorPostService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    private const PATH = "admin.posts.";
    private AuthorPostService $post_service;
    public function __construct(AuthorPostService $post_service)
    {
        $this->post_service = $post_service;
    }

    public function index(PostFilterRequest $request)
    {
        if ($request->ajax()) {
            return $this->post_service->getAllDataForDatatableWithAdmin($request);
        }
        return view(self::PATH.'index');
    }

    public function show(string $post_uuid)
    {
        try {
            $post = Post::query()
                ->select('posts.created_at', 'posts.title as post_title', 'posts.content as post_content', 'posts.uuid as post_uuid', 'posts.order as post_order_no')
                ->addSelect('post_statuses.name as post_status_name', 'post_statuses.code as post_status_code')
                ->addSelect('morph_images.image_name', 'morph_images.path as image_path', 'morph_images.image_type')
                ->addSelect('users.name as user_name',  'users.surname as user_surname', 'users.email as user_email')
                ->join('users', 'users.id', '=', 'posts.user_id')
                ->join('post_statuses', 'post_statuses.id', '=', 'posts.post_status_id')
                ->join('morph_images', function ($join) {
                    $join->on('morph_images.imageable_id', '=', 'posts.id')
                        ->where('morph_images.imageable_type',  Post::class);
                })
                ->where('posts.uuid', $post_uuid)
                ->first();

            return view(self::PATH.'show', compact('post'));
        } catch (\Exception $exception) {
            dd($exception->getMessage());
            abort(404);
        }
    }
}

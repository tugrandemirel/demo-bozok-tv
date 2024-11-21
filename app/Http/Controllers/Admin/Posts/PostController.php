<?php

namespace App\Http\Controllers\Admin\Posts;

use App\Helpers\Response\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Posts\PostFilterRequest;
use App\Http\Requests\Admin\Posts\PostUpdateRequest;
use App\Models\Post;
use App\Models\PostReview;
use App\Models\PostStatus;
use App\Service\Posts\AuthorPostService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

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
        return view(self::PATH . 'index');
    }

    public function show(string $post_uuid)
    {
        try {
            $post = Post::query()
                ->select('posts.created_at', 'posts.title as post_title', 'posts.content as post_content', 'posts.uuid as post_uuid', 'posts.order as post_order_no')
                ->addSelect('post_statuses.name as post_status_name', 'post_statuses.code as post_status_code')
                ->addSelect('morph_images.image_name', 'morph_images.path as image_path', 'morph_images.image_type')
                ->addSelect('users.name as user_name', 'users.surname as user_surname', 'users.email as user_email')
                ->join('users', 'users.id', '=', 'posts.user_id')
                ->join('post_statuses', 'post_statuses.id', '=', 'posts.post_status_id')
                ->join('morph_images', function ($join) {
                    $join->on('morph_images.imageable_id', '=', 'posts.id')
                        ->where('morph_images.imageable_type', Post::class);
                })
                ->where('posts.uuid', $post_uuid)
                ->first();

            /** @var PostReview $post_review */
            $post_reviews = PostReview::query()
                ->with(['status', 'user'])
                ->whereRelation("post", "uuid", "=", $post->post_uuid)
                ->get();

            return view(self::PATH . 'show', compact('post', 'post_reviews'));
        } catch (\Exception $exception) {
            abort(404);
        }
    }

    public function update(PostUpdateRequest $request): JsonResponse
    {
        $attributes = collect($request->validated());
        $post_uuid = $attributes->get('post_uuid');
        $attributes->forget('post_uuid');
        $post_status_code = $attributes->get('post_status_code');
        $attributes->forget('post_status_code');

        DB::beginTransaction();
        try {

            /** @var PostStatus $post_rejected */
            $post_rejected = PostStatus::query()
                ->select('code', 'id')
                ->rejected()
                ->first();

            /** @var PostStatus $post_pending */
            $post_pending = PostStatus::query()
                ->select('code', 'id')
                ->pending()
                ->first();

            /** @var PostStatus $post_status */
            $post_status = PostStatus::query()
                ->select('id', 'code')
                ->where('code', $post_status_code)
                ->first();

            /** @var Post $post */
            $post = Post::query()
                ->where('uuid', $post_uuid)
                ->first();

            if ($post_rejected->code === $post_status->code || $post_pending->code === $post_status_code->code) {
                $post_review = $post->reviews()
                    ->create([
                        'user_id' => auth()->id(),
                        "post_status_id" => $post_status->id,
                        'review_note' => $attributes->get('review_note')
                    ]);
            }
            $post->update([
                'post_status_id' => $post_status->id
            ]);

            DB::commit();
            return ResponseHelper::success('Köşe yazısı yayın durumu başarılu bir şekilde gerçekleştirildi.');
        } catch (\Exception $exception) {
            DB::rollBack();
            dd($exception->getMessage());
            return ResponseHelper::error('Bir hata oluştur: ', $exception->getMessage());
        }
    }
}

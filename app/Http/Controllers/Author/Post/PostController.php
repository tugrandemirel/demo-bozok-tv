<?php

namespace App\Http\Controllers\Author\Post;

use App\Helper\ImageHelper;
use App\Helpers\Response\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Author\Posts\PostFilterRequest;
use App\Http\Requests\Author\Posts\PostStoreRequest;
use App\Http\Requests\Author\Posts\PostUpdateRequest;
use App\Models\Post;
use App\Models\PostReview;
use App\Models\PostStatus;
use App\Service\Posts\AuthorPostService;
use App\Service\Seo\SeoService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostController extends Controller
{
    private const PATH = 'author.posts.';
    protected SeoService $seo_service;
    protected AuthorPostService $author_post_service;
    public function __construct(AuthorPostService $author_post_service, SeoService $seo_service)
    {
        $this->author_post_service = $author_post_service;
        $this->seo_service = $seo_service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(PostFilterRequest $request)
    {
        try {
            if ($request->ajax()) {
                return $this->author_post_service->getAllDataForDatatable($request);
            }
            return view(self::PATH.'index');
        } catch (\Exception $exception){
            abort(404);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(self::PATH.'create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostStoreRequest $request): JsonResponse
    {
        $attributes = collect($request->validated());

        $file = $attributes->get('file');
        $attributes->forget('file');

        $attributes->put('uuid', Str::uuid());
        DB::beginTransaction();
        try {
            $pending = PostStatus::query()
                ->select('id')
                ->pending()
                ->first();

            $attributes->put('post_status_id', $pending->id);

            $user = auth()->user();
            $post = $user->posts()
                ->create($attributes->toArray());

            if ($file) {
                $image = ImageHelper::uploadImage($file);
                $gallery_image['uuid'] = Str::uuid();
                $gallery_image['alt_text'] = $post->title;
                $gallery_image['created_by_user_id'] = $user->id;
                $gallery_image['is_active'] = $attributes->get('is_active');
                $post->image()
                    ->create($image);
            }
            $this->seo_service->generateSeoData($post);
            DB::commit();
            return ResponseHelper::success('Köşe Yazısı ekleme işlemi başarılı bir şekilde gerçekleştirildi.');
        } catch (\Exception $exception) {
            DB::rollBack();
            return ResponseHelper::error('Bir hata oluştu', [$exception->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
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
                ->where('posts.user_id', auth()->id())
                ->first();

            /** @var PostReview $post_review */
            $post_reviews = PostReview::query()
                ->select('post_reviews.review_note', 'post_reviews.created_at')
                ->addSelect('users.name as user_name', "users.surname as user_surname")
                ->addSelect("post_statuses.name as post_status_name", "post_statuses.code as post_status_code",)
                ->join('users', 'users.id', 'post_reviews.user_id')
                ->join('post_statuses', 'post_statuses.id', '=', 'post_reviews.post_status_id')
                ->whereRelation("post", "uuid", "=", $post->post_uuid)
                ->get();

            return view(self::PATH . 'show', compact('post', 'post_reviews'));
        } catch (\Exception $exception) {
            dd($exception->getMessage());
            abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $post_uuid)
    {
        try {
            $user = auth()->user();

            $post = Post::query()
                ->select('posts.created_at', 'posts.title as post_title', 'posts.uuid as post_uuid', 'posts.content as post_content')
                ->addSelect('morph_images.image_name', 'morph_images.path as image_path', 'morph_images.image_type')
                ->join('users', 'users.id', '=', 'posts.user_id')
                ->join('morph_images', function ($join) {
                    $join->on('morph_images.imageable_id', '=', 'posts.id')
                        ->where('morph_images.imageable_type',  Post::class);
                })
                ->where("posts.user_id", $user->id)
                ->where("posts.uuid", $post_uuid)
                ->first();
            return view(self::PATH.'edit', compact('post'));
        } catch (\Exception $exception) {
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostUpdateRequest $request): JsonResponse
    {
        $attributes = collect($request->validated());

        $file = $attributes->get('file');
        $attributes->forget('file');
        $post_uuid = $attributes->get('post_uuid');
        $attributes->forget('post_uuid');
        DB::beginTransaction();
        try {
            $pending = PostStatus::query()
                ->select('id')
                ->pending()
                ->first();

            $attributes->put('post_status_id', $pending->id);

            $user = auth()->user();
            $post =  Post::query()
                ->whereRelation('user', 'id', '=', $user->id)
                ->where('uuid', $post_uuid)
                ->first();

            if ($file) {
                $post_image = $post->image;


                $image = ImageHelper::updateImage($file, $post_image->path);
                $image['alt_text'] = $post->title;
                $image['created_by_user_id'] = $user->id;
                $image['is_active'] = $attributes->get('is_active');

                $post_image->update($image);
            }
            $post->update($attributes->toArray());

            $this->seo_service->generateSeoData($post);
            DB::commit();
            return ResponseHelper::success('Köşe Yazısı ekleme işlemi başarılı bir şekilde gerçekleştirildi.');
        } catch (\Exception $exception) {
            DB::rollBack();dd($exception->getMessage());
            return ResponseHelper::error('Bir hata oluştu', [$exception->getMessage()]);
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

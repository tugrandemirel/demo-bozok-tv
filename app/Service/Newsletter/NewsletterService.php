<?php

namespace App\Service\Newsletter;

use App\Http\Requests\Admin\Newsletter\NewsletterFilterRequest;
use App\Http\Resources\Admin\Newsletter\NewsletterResource;
use App\Interfaces\Repositories\NewsletterRepositoryInterface;
use App\Models\Newsletter;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class NewsletterService implements NewsletterRepositoryInterface
{
    public function getAllDataForDatatable(NewsletterFilterRequest|Request $request): JsonResponse
    {
        $newsletters = Newsletter::query()
            ->select(
                'newsletters.id',
                'newsletters.title',
                'newsletters.publish_date',
                'newsletters.uuid',
                'categories.name as category_name',
                'morph_images.image_name',
                'morph_images.path',
                'morph_images.image_type', // image_type
                'newsletter_publication_statuses.name as status_name',
                'newsletter_publication_statuses.code as status_code',
                'tags.name as tag_name',
                DB::raw('COUNT(DISTINCT newsletter_tags.id) as tag_count'),
                DB::raw('COUNT(DISTINCT morph_images.id) as image_count')
            )
            ->join('categories', 'categories.id', '=', 'newsletters.category_id')
            ->leftJoin('newsletter_tags', 'newsletter_tags.newsletter_id', '=', 'newsletters.id')
            ->leftJoin('tags', 'tags.id', '=', 'newsletter_tags.tag_id')
            ->leftJoin('morph_images', function ($join) {
                $join->on('morph_images.imageable_id', '=', 'newsletters.id')
                    ->where('morph_images.imageable_type', '=', Newsletter::class)
                    ->whereIn('morph_images.image_type',  ['COVER', 'INSIDE', 'FEATURED']);
            })
            ->join('newsletter_publication_statuses', 'newsletter_publication_statuses.id', '=', 'newsletters.newsletter_publication_status_id')
            ->groupBy(
                'newsletters.id',
                'newsletters.title',
                'newsletters.publish_date',
                'newsletters.uuid',
                'categories.name',
                'morph_images.image_name',
                'morph_images.path',
                'morph_images.image_type',
                'tags.name',
                'newsletter_publication_statuses.name',
                'newsletter_publication_statuses.code'
            )
            ->orderBy('newsletters.order', 'desc')
            ->get()
            ->groupBy('id', '')
            ->map(function ($items) {
                $newsletter = $items->first(); // İlk veriyi al
                $tags = $items->pluck('tag_name')->filter()->values(); // Tag bilgilerini al

                $newsletter->tags = $tags; // Tags bilgisini newsletter'a ekle
                // Her bir image_type için değişkenleri başlat
                $newsletter->image_cover = null;
                $newsletter->image_inside = null;
                $newsletter->image_featured = null;

                foreach ($items as $row) {
                    // Image türüne göre değişkenleri ayarla
                    switch ($row->image_type) {
                        case 'COVER':
                            $newsletter->image_cover = [
                                'name' => $row->image_name,
                                'path' => $row->path,
                            ];
                            break;
                        case 'INSIDE':
                            $newsletter->image_inside = [
                                'name' => $row->image_name,
                                'path' => $row->path,
                            ];
                            break;
                        case 'FEATURED':
                            $newsletter->image_featured = [
                                'name' => $row->image_name,
                                'path' => $row->path,
                            ];
                            break;
                    }
                }

                return $newsletter;
            });

        return DataTables::of(NewsletterResource::collection($newsletters))->make(true);
    }

    public function getMainHeadlines()
    {

    }
}

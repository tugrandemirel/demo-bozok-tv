<?php

namespace App\Repositories;

use App\Enum\MorphImage\MorphImageImageTypeEnum;
use App\Enum\Newsletter\NewsletterGeneralEnum;
use App\Http\Requests\Admin\Newsletter\NewsletterFilterRequest;
use App\Interfaces\Repositories\NewsletterRepositoryInterface;
use App\Models\Newsletter;
use App\Models\NewsletterFiveCuff;
use App\Models\NewsletterPublicationStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NewsletterRepository implements NewsletterRepositoryInterface
{
    public function getAllDataForDatatable(NewsletterFilterRequest|Request $request)
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

        return $newsletters;
    }

    public function getLastMinuteNewsletters()
    {
        $newsletter_publication_status_active = self::getNewsletterStatusActiveCode();

        /** @var Newsletter $last_minute_newsletters */
        $last_minute_newsletters = Newsletter::query()
            ->select("title", "slug", "created_at")
            ->lastMinute()
            ->with([
                "status" => function ($query) use ($newsletter_publication_status_active) {
                    $query->where('code', $newsletter_publication_status_active);
                }
            ])
            ->orderByDesc("order")
            ->limit(5)
            ->get();

        return $last_minute_newsletters;
    }

    public function getFeaturedNews(Request $request)
    {
        $newsletter_publication_status_active = self::getNewsletterStatusActiveCode();

        $featured_news = Newsletter::query()
            ->select("id", "title", "slug")
            ->outStanding()
            ->with([
                "status" => function ($query) use ($newsletter_publication_status_active) {
                    $query->where('code', $newsletter_publication_status_active);
                },
                "image" => function ($query) {
                    $query->select("path", "id", "imageable_id")
                        ->where("image_type", MorphImageImageTypeEnum::COVER);
                },
                "seoSetting",
            ])
            ->orderByDesc("order")
            ->limit(2)
            ->get();

        return $featured_news;
    }

    public function getNewsletter($slug)
    {
        $newsletter_publication_status_active = self::getNewsletterStatusActiveCode();
        $newsletter_publication_status_archive = self::getNewsletterStatusArchiveCode();

        $newsletter = Newsletter::query()
            ->whereHas('status', function ($query) use ($newsletter_publication_status_active, $newsletter_publication_status_archive) {
                $query->whereIn('code', [$newsletter_publication_status_active, $newsletter_publication_status_archive]);
            })
            ->where('slug',  $slug)
            ->with([
                "seoSetting",
                "images",
                "category",
                "source"
            ])
            ->first();

        return $newsletter;
    }

    public function getTodayHeadlineNewsletters()
    {
        $newsletter_publication_status_active = self::getNewsletterStatusActiveCode();
        $newsletter_publication_status_archive = self::getNewsletterStatusArchiveCode();

        $newsletter = Newsletter::query()
            ->whereHas('status', function ($query) use ($newsletter_publication_status_active, $newsletter_publication_status_archive) {
                $query->whereIn('code', [$newsletter_publication_status_active, $newsletter_publication_status_archive]);
            })
            ->where('is_today_headline', NewsletterGeneralEnum::ON)
            ->with([
                "seoSetting",
                "image",
            ])
            ->limit(3)
            ->orderBy("order")
            ->get();

        return $newsletter;
    }

    public function getLastNewsletters()
    {
        $newsletter_publication_status_active = self::getNewsletterStatusActiveCode();
        $newsletter_publication_status_archive = self::getNewsletterStatusArchiveCode();

        $newsletters = Newsletter::query()
            ->whereHas('status', function ($query) use ($newsletter_publication_status_active, $newsletter_publication_status_archive) {
                $query->whereIn('code', [$newsletter_publication_status_active, $newsletter_publication_status_archive]);
            })
            ->with([
                "seoSetting",
                "image",
            ])
            ->limit(10)
            ->orderBy("order")
            ->get();

        return $newsletters;
    }

    public static function getNewsletterStatusActiveCode()
    {
        return NewsletterPublicationStatus::query()
            ->select("code")
            ->onTheAir()
            ->first()
            ->code;
    }

    public static function getNewsletterStatusArchiveCode()
    {
        return NewsletterPublicationStatus::query()
            ->select("code")
            ->archive()
            ->first()
            ->code;
    }
}

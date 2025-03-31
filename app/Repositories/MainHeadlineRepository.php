<?php

namespace App\Repositories;

use App\Enum\Ads\AdsIsActiveEnum;
use App\Enum\Category\CategoryIsActiveEnum;
use App\Enum\MorphImage\MorphImageImageTypeEnum;
use App\Interfaces\Repositories\MainHeadlineRepositoryInterface;
use App\Models\Ads;
use App\Models\MainHeadline;
use App\Models\Newsletter;
use App\Models\NewsletterPublicationStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class MainHeadlineRepository implements MainHeadlineRepositoryInterface
{
    public function getMainHeadlines()
    {
        $publicationStatus = NewsletterPublicationStatus::onTheAir()->first();
        if (!$publicationStatus) {
            return collect();
        }

        return MainHeadline::query()
            ->select(
                "main_headlines.headlineable_type",
                "main_headlines.headlineable_id",
                "main_headlines.order",
                "main_headlines.uuid",
                "main_headlines.created_at"
            )
            // Newsletter tablosuna JOIN ekle
            ->leftJoin('newsletters', function ($join) {
                $join->on('main_headlines.headlineable_id', '=', 'newsletters.id')
                    ->where('main_headlines.headlineable_type', Newsletter::class);
            })
            ->whereHasMorph(
                'headlineable',
                [Newsletter::class, Ads::class],
                function (Builder $query, $type) use ($publicationStatus) {
                    if ($type === Newsletter::class) {
                        $query->whereHas('status', function ($q) use ($publicationStatus) {
                            $q->where('code', $publicationStatus->code);
                        })->whereHas('category', function ($q) {
                            $q->where('is_active', CategoryIsActiveEnum::ACTIVE);
                        });
                    } elseif ($type === Ads::class) {
                        $query->where('is_active', AdsIsActiveEnum::ACTIVE);
                    }
                }
            )
            ->with(['headlineable' => function (MorphTo $morphTo) {
                $morphTo->constrain([
                    Newsletter::class => function (Builder $query) {
                        $query->select('id', 'title', 'slug', 'category_id', 'newsletter_publication_status_id', 'order')
                        ->with([
                            'image' => function ($q) {
                                $q->where('image_type', MorphImageImageTypeEnum::COVER);
                            },
                            'seoSetting',
                            'category'
                        ]);
                    },
                    Ads::class => function (Builder $query) {
                        $query->select('id', 'is_active')
                            ->with('image');
                    }
                ]);
            }])
            // Newsletter order'a göre sırala, yoksa main_headlines.order kullan
            ->orderByRaw('CASE WHEN main_headlines.headlineable_type = ? THEN newsletters.order ELSE main_headlines.order END DESC', [Newsletter::class])
            ->orderBy('order', 'desc')
            ->limit(20)
            ->get();
    }
}

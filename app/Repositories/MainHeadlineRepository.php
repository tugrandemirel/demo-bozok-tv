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
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class MainHeadlineRepository implements MainHeadlineRepositoryInterface
{
    public function getMainHeadlines()
    {
        // 1. Yayın durumunu kontrol et
        $publicationStatus = NewsletterPublicationStatus::onTheAir()->first();
        if (!$publicationStatus) {
            return collect(); // İsteğe bağlı hata fırlatılabilir
        }

        // 2. MainHeadline sorgusunu oluştur
        return MainHeadline::query()
            ->select("headlineable_type", "headlineable_id", "order", "uuid", "created_at")
            ->whereHasMorph(
                'headlineable',
                [Newsletter::class, Ads::class],
                function (Builder $query, $type) use ($publicationStatus) {
                    // Newsletter Filtreleri
                    if ($type === Newsletter::class) {
                        $query->whereHas('status', function ($q) use ($publicationStatus) {
                            $q->where('code', $publicationStatus->code);
                        })->whereHas('category', function ($q) {
                            $q->where('is_active', CategoryIsActiveEnum::ACTIVE);
                        });
                    }
                    // Ads Filtresi
                    elseif ($type === Ads::class) {
                        $query->where('is_active', AdsIsActiveEnum::ACTIVE);
                    }
                }
            )
            ->with(['headlineable' => function (MorphTo $morphTo) {
                $morphTo->constrain([
                    Newsletter::class => function (Builder $query) {
                        $query->select('id', 'title', 'slug', 'category_id', 'newsletter_publication_status_id')
                            ->with([
                                'image' => function ($q) {
                                    $q->where('image_type', MorphImageImageTypeEnum::COVER);
                                },
                                'seoSetting',
                                'category'
                            ]);
                    },
                    Ads::class => function (Builder $query) {
                        $query->select('id', 'title', 'is_active')
                            ->with('image');
                    }
                ]);
            }])
            ->orderBy('order', 'desc')
            ->orderBy('created_at', 'desc')
            ->limit(20)
            ->get();
    }
}

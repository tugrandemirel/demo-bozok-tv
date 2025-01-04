<?php

namespace App\Repositories;

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
        /** @var NewsletterPublicationStatus $newsletter_publication_status */
        $newsletter_publication_status = NewsletterPublicationStatus::query()
            ->onTheAir()
            ->select("code")
            ->first();

        /** @var Mainheadline $main_headlines */
        $main_headlines = MainHeadline::query()
            ->select("headlineable_type", "headlineable_id", "order", "uuid")
            ->with('headlineable', function (MorphTo $morphTo) use ($newsletter_publication_status) {
                $morphTo->constrain([
                    Newsletter::class => function (Builder $qu) use ($newsletter_publication_status) {
                        $qu->select("id","title", "category_id", "newsletter_publication_status_id", "slug");
                        $qu->with([
                            'image' => function ($q) {
                                $q->where('image_type', MorphImageImageTypeEnum::COVER);
                            },
                            'seoSetting',
                            "category"
                        ]);
                        $qu->whereHas("status", function ($q) use ($newsletter_publication_status){
                            $q->where("code", $newsletter_publication_status->code);
                        });
                    },
                    Ads::class => function ($qu) {
                        $qu->where('is_active', \App\Enum\Ads\AdsIsActiveEnum::ACTIVE);
                        $qu->with('image');
                    }
                ]);
            })
            ->limit(20)
            ->orderByDesc('order')
            ->get();

        return $main_headlines;
    }
}

<?php

namespace App\Observers;

use App\Models\MainHeadline;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class MainHeadlineObserve
{
    /**
     * Handle the MainHeadline "created" event.
     */
    public function creating(MainHeadline $mainHeadline): void
    {
//        if (!Auth::check()) {
//            throw new \Exception('Lütfen kullanıcı girişi yapınız.');
//        }
//
//        $mainHeadline->uuid = Str::uuid();
//        $mainHeadline->created_by_user_id = Auth::id();
    }

    /**
     * Handle the MainHeadline "updated" event.
     */
    public function updated(MainHeadline $mainHeadline): void
    {
        //
    }

    /**
     * Handle the MainHeadline "deleted" event.
     */
    public function deleted(MainHeadline $mainHeadline): void
    {
        //
    }

    /**
     * Handle the MainHeadline "restored" event.
     */
    public function restored(MainHeadline $mainHeadline): void
    {
        //
    }

    /**
     * Handle the MainHeadline "force deleted" event.
     */
    public function forceDeleted(MainHeadline $mainHeadline): void
    {
        //
    }
}

<?php

namespace App\Listeners;

use App\Events\UserActivityLogged;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogUserActivity
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserActivityLogged $event): void
    {
        $event->userActivity->save();
    }
}

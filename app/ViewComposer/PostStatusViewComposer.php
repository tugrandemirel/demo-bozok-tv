<?php

namespace App\ViewComposer;

use App\Models\PostStatus;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class PostStatusViewComposer
{
    public function compose(View $view): void
    {
        $post_statuses = Cache::rememberForever('post_status', function (){
            return PostStatus::query()
                ->select('name', 'code')
                ->get();
        });

        $view->with('post_statuses', $post_statuses);
    }
}

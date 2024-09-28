<?php

namespace App\ViewComposer;

use App\Enum\Category\CategoryIsActiveEnum;
use App\Models\Category;
use Illuminate\View\View;

class CategoryViewComposer
{
    public function compose(View $view): void
    {
        /** @var Category $categories */
        $categories = Category::query()
            ->select('uuid', 'name', 'id')
            ->where('is_active', CategoryIsActiveEnum::ACTIVE)
            ->orderBy('order')
            ->get();


        $view->with('categories', $categories);
    }
}

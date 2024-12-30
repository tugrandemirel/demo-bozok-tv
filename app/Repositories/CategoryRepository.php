<?php

namespace App\Repositories;

use App\Enum\Category\CategoryHomePageEnum;
use App\Enum\Category\CategoryIsActiveEnum;
use App\Interfaces\Repositories\CategoryRepositoryInterface;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function getCategories(Request $request): Collection|array
    {
        /** @var Category $categories */
        $categories = Category::query()
            ->select('name', "slug")
            ->where("is_active", CategoryIsActiveEnum::ACTIVE)
            ->where("home_page", CategoryHomePageEnum::ACTIVE)
            ->get();

        return $categories;
    }
}

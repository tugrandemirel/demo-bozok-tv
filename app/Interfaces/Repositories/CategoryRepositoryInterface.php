<?php

namespace App\Interfaces\Repositories;

use Illuminate\Http\Request;

interface CategoryRepositoryInterface
{
    public function getCategories(Request $request);

    public function getCategoryNewsletters(Request $request, string $slug);
    public function getCategoryBySlugNewsletters(Request $request, string $slug);
    public function getRelatedNewsletters(Request $request, string $slug);
}

<?php

namespace App\Interfaces\Repositories;

use Illuminate\Http\Request;

interface CategoryRepositoryInterface
{
    public function getCategories(Request $request);
}

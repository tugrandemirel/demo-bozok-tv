<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show($category_slug)
    {
        return view("front.category.show", compact('category_slug'));
    }
}

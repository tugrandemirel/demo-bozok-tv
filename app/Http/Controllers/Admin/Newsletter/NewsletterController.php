<?php

namespace App\Http\Controllers\Admin\Newsletter;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    private const PATH = 'admin.newsletter.';

    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view(self::PATH.'index');
    }

    public function create()
    {
        return view('admin.newsletter.create.create');
    }
}

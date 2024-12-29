<?php

namespace App\Http\Controllers;

use App\Service\MainHeadline\MainHeadlineService;
use Illuminate\Http\Request;

class TestController extends Controller
{
    private MainHeadlineService $main_headline_service;
    public function __construct(MainHeadlineService $main_headline_service)
    {
        $this->main_headline_service = $main_headline_service;
    }

    public function index()
    {
        return $this->main_headline_service->getMainHeadlines();
    }
}

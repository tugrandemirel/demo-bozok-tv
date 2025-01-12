<?php

namespace App\Interfaces\Repositories;

use Illuminate\Http\Request;

interface NewsletterRepositoryInterface
{
    public function getAllDataForDatatable(Request $request);

    public function getLastMinuteNewsletters();

    public function getFeaturedNews(Request $request);

    public function getNewsletter($slug);

    public function getTodayHeadlineNewsletters();

    public function getLastNewsletters();
}

<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Service\Api\V2\Categories\CategoryService;
use App\Service\Api\V2\Categories\PoliticNewsletterService;
use App\Service\Api\V2\Galleries\PhotoGalleryService;
use App\Service\Api\V2\Newsletters\LastMinuteService;
use App\Service\Api\V2\Newsletters\LastNewsletterService;
use App\Service\Api\V2\Newsletters\NewsletterFiveCuffService;
use App\Service\Api\V2\Newsletters\NewsletterOutStandingService;
use App\Service\Api\V2\Newsletters\NewsletterTodayHeadlineService;
use App\Service\MainHeadline\MainHeadlineService;

class HomeController extends Controller
{

    private MainHeadlineService $main_headline_service;
    private NewsletterFiveCuffService $newsletter_five_cuff_service;
    private NewsletterTodayHeadlineService $newsletter_today_headline_service;
    private LastNewsletterService $last_newsletter_service;
    private PoliticNewsletterService $politic_newsletter_service;
    private NewsletterOutStandingService $newsletter_outstandings_service;
    private LastMinuteService $last_minute_service;
    private PhotoGalleryService $photo_gallery_service;
    private CategoryService $category_service;
    public function __construct(
        MainHeadlineService $main_headline_service,
        NewsletterFiveCuffService $newsletter_five_cuff_service,
        NewsletterTodayHeadlineService $newsletter_today_headline_service,
        LastNewsletterService $last_newsletter_service,
        PoliticNewsletterService $politic_newsletter_service,
        NewsletterOutStandingService $newsletter_outstandings_service,
        LastMinuteService $last_minute_service,
        PhotoGalleryService $photo_gallery_service,
        CategoryService $category_service
    ){
        $this->main_headline_service = $main_headline_service;
        $this->newsletter_five_cuff_service = $newsletter_five_cuff_service;
        $this->newsletter_today_headline_service = $newsletter_today_headline_service;
        $this->last_newsletter_service = $last_newsletter_service;
        $this->politic_newsletter_service = $politic_newsletter_service;
        $this->newsletter_outstandings_service = $newsletter_outstandings_service;
        $this->last_minute_service = $last_minute_service;
        $this->photo_gallery_service = $photo_gallery_service;
        $this->category_service = $category_service;
    }

    public function index()
    {
        $main_headlines = $this->main_headline_service->getMainHeadlines();
        $newsletter_five_cuffs = $this->newsletter_five_cuff_service->getFiveCuffs();
        $newsletter_today_headlines = $this->newsletter_today_headline_service->getNewsletterTodayHeadlines();
        $last_newsletters = $this->last_newsletter_service->getLastNewsletters();

        $politic_newsletter_outstandings = $this->politic_newsletter_service->getPoliticNewslettersWithOutstanding();
        $politic_newsletters_today_headlines = $this->politic_newsletter_service->getPoliticNewslettersWithTodayHeadlines();
        $politic_newsletters_main_headlines = $this->politic_newsletter_service->getPoliticNewslettersWithMainHeadlines();
        $newsletter_outstandings = $this->newsletter_outstandings_service->getNewsletterOutstandings();
        $last_minutes = $this->last_minute_service->getLastMinutes();
        $photo_galleries = $this->photo_gallery_service->getGalleries();
        $sport_outstandings = $this->category_service->getSlugByOutstandings("spor");
        $world_outstandings = $this->category_service->getSlugByOutstandings("dunya");
        $agenda_outstandings = $this->category_service->getSlugByOutstandings("gundem");
        $economi_outstandings = $this->category_service->getSlugByOutstandings("ekonomi");
        return view('front.index', compact(
            "main_headlines", "newsletter_five_cuffs", "newsletter_today_headlines",
            "last_newsletters", "politic_newsletter_outstandings", "politic_newsletters_today_headlines",
            "politic_newsletters_main_headlines", "newsletter_outstandings", "last_minutes", "photo_galleries",
            "world_outstandings", "agenda_outstandings", "economi_outstandings", "sport_outstandings"
        ));
    }
}

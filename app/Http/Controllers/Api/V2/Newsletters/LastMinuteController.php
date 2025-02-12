<?php

namespace App\Http\Controllers\Api\V2\Newsletters;

use App\Helpers\Response\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Service\Api\V2\Newsletters\LastMinuteService;
use Illuminate\Http\Request;

class LastMinuteController extends Controller
{
    private LastMinuteService $last_minute_service;

    public function __construct(LastMinuteService $last_minute_service)
    {
        $this->last_minute_service = $last_minute_service;
    }

    public function index()
    {
        $last_minutes = $this->last_minute_service->getLastMinutes();
        return ResponseHelper::success("Son Dakika haberleri başarılı bir şekilde çekildi.", ["data" => $last_minutes], 200);
    }
}

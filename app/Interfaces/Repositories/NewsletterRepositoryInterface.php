<?php

namespace App\Interfaces\Repositories;

use Illuminate\Http\Request;

interface NewsletterRepositoryInterface
{
    public function getAllDataForDatatable(Request $request);
}

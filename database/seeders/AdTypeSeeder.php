<?php

namespace Database\Seeders;

use App\Models\AdType;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ads_types = [
            [
                "name" => "Özel Reklam",
                "code" => "special_ads",
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now()
            ],
            [
                "name" => "Google Reklam",
                "code" => "google_ads",
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now()
            ],
        ];

        AdType::query()->insert($ads_types);
    }
}

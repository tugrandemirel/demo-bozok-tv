<?php

namespace Database\Seeders;

use App\Models\Placement;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlacementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $placements = [
            [
                "name" => "Ana Manşet",
                "code" => "main_headline",
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now()
            ]
        ];

        Placement::query()->insert($placements);
    }
}

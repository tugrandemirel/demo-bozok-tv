<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            [
                "name" => "Aktif",
                "code" => "active",
            ],
            [
                "name" => "Pasif",
                "code" => "passive",
            ],
        ];

        foreach ($statuses as $status) {
            \App\Models\CommentStatus::query()->create($status);
        }
    }
}

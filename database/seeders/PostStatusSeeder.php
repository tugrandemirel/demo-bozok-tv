<?php

namespace Database\Seeders;

use App\Models\PostStatus;
use Illuminate\Database\Seeder;

class PostStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            [
                'name' => 'Bekliyor',
                'code' => 'pending',
            ],
            [
                'name' => 'Onaylandı',
                'code' => 'approved',
            ],
            [
                'name' => 'Reddedildi',
                'code' => 'rejected',
            ],
        ];

        foreach ($statuses as $status) {
            PostStatus::query()->create($status);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\NewsletterPublicationStatus;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class NewsletterPublicationStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            [
                'name' => 'Yayında',
                'code' => 'on-the-air',
            ],
            [
                'name' => 'Taslak',
                'code' => 'draft',
            ],
            [
                'name' => 'Arşiv',
                'code' => 'archive',
            ],
        ];


        $user = User::query()
            ->where('email', 'demireltugran66@gmail.com')
            ->firstOrFail();

        foreach ($statuses as $index => $status) {
            NewsletterPublicationStatus::query()
                ->create([
                    'created_by_user_id' => $user->id,
                    'uuid' => Str::uuid(),
                    'name' => $status['name'],
                    'code' => $status['code'],
                ]);
        }
    }
}

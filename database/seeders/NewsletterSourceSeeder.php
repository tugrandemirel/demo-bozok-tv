<?php

namespace Database\Seeders;

use App\Models\NewsletterSource;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class NewsletterSourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sources = [
            [
                'name' => 'Bozok TV',
                'url' => 'https://www.bozok.tv/'
            ],
            [
                'name' => 'İHA',
                'url' => 'https://www.iha.com.tr/'
            ],
            [
                'name' => 'AA',
                'url' => 'https://www.aa.com.tr/'
            ],
        ];

        $user = User::query()
            ->where('email', 'demireltugran66@gmail.com')
            ->firstOrFail();

        foreach ($sources as $index => $source) {
            $newsletterSource = NewsletterSource::query()
                ->create([
                    'uuid' => Str::uuid(),
                    'name' => $source['name'],
                    'slug' => Str::slug($source['name']),
                    'url' => $source['url'],
                    'order' => $index + 1,
                'created_by_user_id' => $user->id,
                ]);

            $newsletterSource->seoSettings()->create([
                'uuid' => Str::uuid(),
                'meta_title' => $source['name'],
                'meta_description' => $source['url'],
                'meta_keywords' => $source['name'],
                'created_by_user_id' => $user->id,
            ]);
        }
    }
}

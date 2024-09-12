<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Dünya',
            'Ekonomi',
            'Teknoloji',
            'Spor',
            'Kültür',
            'Asayiş',
            'Yaşam',
            'Sağlık',
            'Siyaset',
            'Eğitim',
            'Gündem',
            'Turizm',
            'Bilim',
            'Sanat',
            'Çocuk',
            'Resmi İlan',
            'Diğer',
            'Sokak Röportajı',
            'Özel Haber',
        ];

        $user = User::query()
            ->where('email', 'demireltugran66@gmail.com')
            ->firstOrFail();

        foreach ($categories as $index => $category) {
            $c = Category::query()
                ->create([
                    'created_by_user_id' => $user->id,
                    'name' => $category,
                    'slug' => Str::slug($category),
                    'is_active' => true,
                    'home_page' => rand(0, 1),
                    'order' => $index + 1
                ]);

            $c->seoSettings()->create([
                'meta_title' => $category,
                'meta_description' => $category,
                'meta_keywords' => $category,
                'created_by_user_id' => $user->id,
            ]);
        }
    }
}

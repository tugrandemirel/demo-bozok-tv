<?php

namespace Database\Seeders;

use App\Models\MorphImage;
use App\Models\Post;
use App\Models\PostStatus;
use App\Models\User;
use App\Service\Seo\SeoService;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::beginTransaction();
        try {
            $faker = Faker::create();

            // Rolü 'Author' olan kullanıcıları bul
            $authors_ids =  User::role('Author')->pluck('id')->toArray();

            // Post durumlarını çek
            $statuses = PostStatus::query()->pluck('id')->toArray();

            // Her bir kullanıcı için rastgele post oluştur
            for ($i = 0; $i < 15; $i++) { // Her yazar için 1-5 arası post
                $post = Post::query()->create([
                    'title' => $faker->sentence(6, true), // Faker ile rastgele başlık
                    'content' => $faker->paragraph(5, true), // Faker ile rastgele içerik
                    'user_id' => $authors_ids[array_rand($authors_ids)],
                    'post_status_id' => $statuses[array_rand($statuses)], // Rastgele bir durum seç
                ]);

                MorphImage::create([
                    'imageable_id' => $post->id, // Post id'si
                    'imageable_type' => Post::class, // Polymorphic ilişki
                    'image_name' => $faker->word . '.jpg', // Resmin adı (Faker ile)
                    'image_ext' => 'jpg', // Resmin uzantısı (sabit bir değer, faker ile farklı uzantılar da kullanılabilir)
                    'size' => $faker->numberBetween(100, 5000), // Boyut (random byte cinsinden)
                    'path' => $faker->imageUrl(), // Görsel yolu
                    'alt_text' => $faker->sentence(3), // Alt metin (Faker ile)
                    'width' => $faker->numberBetween(300, 1920), // Genişlik
                    'height' => $faker->numberBetween(300, 1080), // Yükseklik
                    'mime_type' => 'image/jpeg', // MIME tipi
                ]);

                $seo = new SeoService();

                $seo->generateSeoData($post);

            }

            $this->command->info('Posts seeded successfully.');
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            $this->command->error($exception->getMessage());
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Survey;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SurveySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::query()
            ->where('email', 'demireltugran66@gmail.com')
            ->first();

        $surveys = [
            ['title' => '2024 Dünya Kupası Takım Anketi', 'description' => 'Bu yılki Dünya Kupası şampiyonunu tahmin edin!', 'status' => 'active', 'start_date' => now(), 'end_date' => now()->addDays(30)],
            ['title' => 'Türkiye’nin En Popüler Şehri', 'description' => '2024 yılında hangi şehir daha popüler olacak?', 'status' => 'active', 'start_date' => now(), 'end_date' => null],
            ['title' => 'Teknoloji Kullanım Alışkanlıkları', 'description' => 'Teknoloji kullanım alışkanlıklarınız nedir?', 'status' => 'active', 'start_date' => now(), 'end_date' => now()->addDays(30)],
            ['title' => 'Çevre Bilinci ve Atık Yönetimi', 'description' => 'Çevre kirliliği ve atık yönetimi hakkında düşünceleriniz?', 'status' => 'active', 'start_date' => now(), 'end_date' => now()->addDays(30)],
            ['title' => 'Türkiye’de Eğitim Sistemi', 'description' => 'Eğitim sistemi hakkında ne düşünüyorsunuz?', 'status' => 'active', 'start_date' => now(), 'end_date' => null],
            ['title' => 'En Sevilen Sosyal Medya Platformları', 'description' => 'Hangi sosyal medya platformu en çok tercih ediliyor?', 'status' => 'active', 'start_date' => now(), 'end_date' => null],
            ['title' => 'Yılın En İyi Filmi', 'description' => '2024 yılında vizyona giren filmler arasında hangisi en iyi?', 'status' => 'active', 'start_date' => now(), 'end_date' => now()->addDays(30)],
            ['title' => 'Sağlık ve Spor Alışkanlıkları', 'description' => 'Spor ve sağlık konusundaki alışkanlıklarınız?', 'status' => 'active', 'start_date' => now(), 'end_date' => now()->addDays(30)],
            ['title' => 'Popüler Müzik Türleri', 'description' => 'En popüler müzik türleri nelerdir?', 'status' => 'active', 'start_date' => now(), 'end_date' => now()->addDays(30)],
            ['title' => 'Türkiye’de En Güvenli Şehir', 'description' => 'Türkiye’deki en güvenli şehir hangisidir?', 'status' => 'active', 'start_date' => now(), 'end_date' => null],
        ];

        // Her bir anketi kaydedelim
        foreach ($surveys as $survey) {
            // Anketi oluşturuyoruz
            Survey::create([
                'uuid' => Str::uuid(),
                'created_by_user_id' => $user->id, // Rastgele bir kullanıcı atıyoruz
                'title' => $survey['title'],
                'description' => $survey['description'],
                'status' => $survey['status'],
                'start_date' => $survey['start_date'],
                'end_date' => $survey['end_date'],
            ]);
        }
    }
}

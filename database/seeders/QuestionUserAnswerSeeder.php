<?php

namespace Database\Seeders;

use App\Models\QuestionAnswerOption;
use App\Models\QuestionUserAnswer;
use App\Models\Survey;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class QuestionUserAnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Kullanıcıları al (login olan ya da olmayan)
        $users = User::query()
            ->get();

        if ($users->isEmpty()) {
            // Eğer veritabanında hiç kullanıcı yoksa, oturum açmamış kullanıcılar için session_id kullanılır
            $sessionId = Str::random(40); // Rastgele bir session_id oluştur
        }

        // Aktif anketleri al
        $surveys = Survey::query()
            ->get(); // Aktif olan anketleri çek

        if ($surveys->isEmpty()) {
            return; // Aktif anket yoksa işlem yapılmaz
        }

        // 10 farklı katılımcı için veri ekle
        for ($i = 0; $i < 10; $i++) {
            // Rasgele bir anket seç
            $survey = $surveys->random();

            // Soruları al
            $questions = $survey->questions; // Anketin tüm soruları

            foreach ($questions as $question) {
                // Bu soruya ait seçenekleri al
                $options = $question->options; // Seçenekler

                // Eğer seçenekler varsa, rastgele bir seçenek seç
                if ($options->isNotEmpty()) {
                    $option = $options->random(); // Seçeneklerden rastgele birini seç
                } else {
                    continue; // Eğer seçenek yoksa, bu soruyu geç
                }

                // Rasgele bir kullanıcı seç
                $user = $users->isNotEmpty() ? $users->random() : null;
                $sessionId = $user ? null : Str::uuid(); // Kullanıcı varsa session_id null olur

                // Eğer kullanıcı login olmuşsa user_id'yi kullan, login olmamışsa session_id'yi kullan
                QuestionUserAnswer::query()
                    ->create([
                    'uuid' => Str::uuid(), // Benzersiz UUID
                    'selected_option_id' => $option->id, // Seçilen cevabın ID'si
                    'user_id' => $user ? $user->id : null, // Kullanıcı varsa user_id'yi ata
                    'session_id' => $user ? null : $sessionId, // Kullanıcı yoksa session_id ata
                ]);
            }
        }
    }
}

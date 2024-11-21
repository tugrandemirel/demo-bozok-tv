<?php

namespace Database\Seeders;

use App\Models\Survey;
use App\Models\SurveyQuestion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SurveyQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Anketleri alıyoruz (önceden oluşturulmuş olmalı)
        $surveys = Survey::all();

        // Her ankete 3-5 arası soru ekliyoruz
        foreach ($surveys as $survey) {
            // 3-5 arasında rastgele soru sayısı belirliyoruz
            $questions = [
                ['question_text' => '2024 Dünya Kupası şampiyonu hangi takım olacak?'],
                ['question_text' => 'Türkiye’deki en popüler tatil bölgesi hangisidir?'],
                ['question_text' => 'En çok hangi sosyal medya platformu kullanılıyor?'],
                ['question_text' => '2024 yılında en çok izlenen film hangisi olacak?'],
                ['question_text' => 'Hangi sağlık alışkanlığına sahip misiniz?'],
            ];

            // Anketin her birine soruları ekliyoruz
            foreach ($questions as $question) {
                SurveyQuestion::query()->create([
                    'uuid' => Str::uuid(), // UUID ile benzersiz ID
                    'survey_id' => $survey->id, // İlgili anketin ID'si
                    'created_by_user_id' => $survey->created_by_user_id, // Anketi oluşturan kişi
                    'question_text' => $question['question_text'], // Sorunun metni
                ]);
            }
        }
    }
}

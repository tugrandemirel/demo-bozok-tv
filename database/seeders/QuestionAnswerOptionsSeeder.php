<?php

namespace Database\Seeders;

use App\Models\QuestionAnswerOption;
use App\Models\SurveyQuestion;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class QuestionAnswerOptionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Tüm soruları al
        $questions = SurveyQuestion::all();

        // Kullanıcıları al
        $user = User::query()
            ->where('email', 'demireltugran66@gmail.com')
            ->first();

        // Sorular için cevap seçenekleri oluştur
        foreach ($questions as $question) {
            // Rastgele 2 ila 5 cevap seçeneği oluştur
            $answerCount = rand(2, 5);

            for ($i = 1; $i <= $answerCount; $i++) {
                QuestionAnswerOption::query()->create([
                    'uuid' => Str::uuid(),
                    'survey_question_id' => $question->id,
                    'created_by_user_id' => $user->id, // Rastgele bir kullanıcı seç
                    'answer_text' => "Option $i for question: {$question->question_text}",
                ]);
            }
        }
    }
}

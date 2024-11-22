<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\QuestionUserAnswer;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            RolesAndPermissionsSeeder::class,
            UserSeeder::class,
            CategorySeeder::class,
            NewsletterSourceSeeder::class,
            NewsletterPublicationStatusSeeder::class,
            PostStatusSeeder::class,
            PostSeeder::class,
            SurveySeeder::class,
            SurveyQuestionSeeder::class,
            QuestionAnswerOptionsSeeder::class,
            SurveyUserKvkkDataSeeder::class,
            QuestionUserAnswerSeeder::class
        ]);
    }
}

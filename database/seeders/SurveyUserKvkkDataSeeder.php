<?php

namespace Database\Seeders;

use App\Models\QuestionUserAnswer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class SurveyUserKvkkDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $browsers = ['Chrome', 'Firefox', 'Safari', 'Edge', 'Opera', 'Internet Explorer'];
        $operatingSystems = ['Windows', 'MacOS', 'Linux', 'iOS', 'Android'];

        // Create 100 random entries for survey_user_kvkk_data
        for ($i = 0; $i < 1000; $i++) {
            DB::table('survey_user_kvkk_data')->insert([
                'uuid' => $faker->uuid(),
                'question_user_answer_id' => QuestionUserAnswer::inRandomOrder()->first()->id,
                'ip_address' => $faker->ipv4(),
                'browser' => $faker->randomElement($browsers),
                'os' => $faker->randomElement($operatingSystems),
                'location' => $faker->optional()->city(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

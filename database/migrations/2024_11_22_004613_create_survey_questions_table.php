<?php

use App\Models\Survey;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('survey_questions', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->foreignIdFor(Survey::class); // Hangi ankete ait olduğu
            $table->foreignIdFor(User::class, 'created_by_user_id'); // Hangi ankete ait olduğu
            $table->string('question_text'); // Sorunun metni
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('survey_questions');
    }
};

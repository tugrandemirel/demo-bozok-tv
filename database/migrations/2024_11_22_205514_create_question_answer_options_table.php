<?php

use App\Models\SurveyQuestion;
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
        Schema::create('question_answer_options', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->unsignedBigInteger('survey_question_id');
            $table->foreignIdFor(User::class, 'created_by_user_id');
            $table->string('answer_text');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('survey_question_id')->references('id')->on('survey_questions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('question_answer_options');
    }
};

<?php

use App\Models\QuestionAnswerOption;
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
        Schema::create('question_user_answers', function (Blueprint $table) {
            $table->id();
            $table->uuid(); // UUID ile benzersiz ID
            $table->unsignedBigInteger('selected_option_id');
            $table->foreignIdFor(User::class)->nullable(); // Kullanıcı giriş yapmışsa user_id
            $table->string('session_id')->nullable(); // Kullanıcı giriş yapmamışsa benzersiz session_id
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('selected_option_id')->references('id')->on('question_answer_options')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('question_user_answers');
    }
};

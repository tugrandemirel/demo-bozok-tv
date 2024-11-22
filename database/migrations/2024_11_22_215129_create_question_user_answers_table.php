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
            $table->foreignIdFor(QuestionAnswerOption::class, 'selected_option_id'); // Kullanıcının seçtiği cevap
            $table->foreignIdFor(User::class)->nullable(); // Kullanıcı giriş yapmışsa user_id
            $table->string('session_id')->nullable(); // Kullanıcı giriş yapmamışsa benzersiz session_id
            $table->timestamps();
            $table->softDeletes();
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

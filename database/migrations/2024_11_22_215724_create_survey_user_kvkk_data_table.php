<?php

use App\Models\QuestionUserAnswer;
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
        Schema::create('survey_user_kvkk_data', function (Blueprint $table) {
            $table->id();
            $table->uuid(); // UUID ile benzersiz KVKK ID'si
            $table->foreignIdFor(QuestionUserAnswer::class); // Yanıtla ilişkili
            $table->string("ip_address"); // Kullanıcının IP adresi
            $table->string("browser"); // Kullanıcının tarayıcı bilgisi
            $table->string("os"); // Kullanıcının işletim sistemi bilgisi
            $table->string("location")->nullable(); // Kullanıcının konumu (isteğe bağlı)
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('survey_user_kvkk_data');
    }
};

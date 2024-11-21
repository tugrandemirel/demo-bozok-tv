<?php

use App\Enum\Survey\SurveyStatusEnum;
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
        Schema::create('surveys', function (Blueprint $table) {
            $table->id();
            $table->uuid(); // UUID ile benzersiz anket ID'si
            $table->foreignIdFor(User::class, 'created_by_user_id'); // UUID ile benzersiz anket ID'si
            $table->string('title'); // Anket başlığı
            $table->text('description')->nullable(); // Anket açıklaması
            $table->timestamp('start_date')->nullable(); // Başlangıç tarihi
            $table->timestamp('end_date')->nullable(); // Bitiş tarihi (isteğe bağlı)
            $table->enum('status', [SurveyStatusEnum::ACTIVE->value, SurveyStatusEnum::INACTIVE->value])->default(SurveyStatusEnum::INACTIVE->value); // Anketin aktif/pasif durumu
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surveys');
    }
};

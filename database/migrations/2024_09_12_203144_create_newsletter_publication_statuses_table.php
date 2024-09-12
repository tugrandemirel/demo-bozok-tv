<?php

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
        Schema::create('newsletter_publication_statuses', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid'); // UUID için sütun adı belirlenmeli
            $table->unsignedBigInteger('created_by_user_id');
            $table->string('name');
            $table->string('code');
            $table->timestamps();
            $table->softDeletes();

            // Foreign key tanımı
            $table->foreign('created_by_user_id') // Hangi sütunun foreign key olacağını belirtin
            ->references('id') // Hangi sütuna referans olduğunu belirtin (genellikle 'id')
            ->on('users'); // Hangi tabloya referans olduğunu belirtin

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('newsletter_publication_statuses');
    }
};

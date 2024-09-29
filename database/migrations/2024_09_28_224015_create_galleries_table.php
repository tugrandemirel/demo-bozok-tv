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
        Schema::create('galleries', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->foreignIdFor(User::class, 'created_by_user_id')->index();
            $table->string('title');
            $table->string('slug');
            $table->string('description');
            $table->enum('type', ['VIDEO', 'IMAGE']);
            $table->integer('order')->nullable();
            $table->boolean('is_active');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galleries');
    }
};

<?php

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
        Schema::create('seo_settings', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->foreignIdFor(\App\Models\User::class, 'created_by_user_id');
            $table->morphs('seoable');
            $table->string('meta_title');
            $table->string('meta_description');
            $table->string('meta_keywords');
            $table->string('canonical_url')->nullable(); // Canonical URL
            $table->string('og_title')->nullable(); // Open Graph başlığı
            $table->string('og_description')->nullable(); // Open Graph açıklaması
            $table->string('og_image')->nullable(); // Open Graph resmi
            $table->string('twitter_title')->nullable(); // Twitter başlığı
            $table->string('twitter_description')->nullable(); // Twitter açıklaması
            $table->string('twitter_image')->nullable(); // Twitter resmi
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seo_settings');
    }
};

<?php

use App\Enum\Newsletter\NewsletterGeneralEnum;
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
        Schema::create('newsletters', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->foreignIdFor(\App\Models\Category::class);
            $table->foreignIdFor(\App\Models\NewsletterSource::class);
            $table->foreignIdFor(\App\Models\NewsletterPublicationStatus::class);
            $table->foreignIdFor(\App\Models\User::class, 'created_by_user_id');
            $table->string('title');
            $table->text('spot');
            $table->text('content');
            $table->boolean('is_main_headline')->default(NewsletterGeneralEnum::OFF->value);
            $table->boolean('is_five_cuff')->default(NewsletterGeneralEnum::OFF->value);
            $table->boolean('is_outstanding')->default(NewsletterGeneralEnum::OFF->value);
            $table->boolean('is_last_minute')->default(NewsletterGeneralEnum::OFF->value);
            $table->boolean('is_today_headline')->default(NewsletterGeneralEnum::OFF->value);
            $table->boolean('is_special_news')->default(NewsletterGeneralEnum::OFF->value);
            $table->boolean('is_street_interview')->default(NewsletterGeneralEnum::OFF->value);
            $table->boolean('is_seo')->default(NewsletterGeneralEnum::OFF->value);
            $table->dateTime('publish_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('newsletters');
    }
};
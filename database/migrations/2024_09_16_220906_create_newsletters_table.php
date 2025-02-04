<?php

use App\Enum\Newsletter\NewsletterGeneralEnum;
use App\Models\Category;
use App\Models\NewsletterPublicationStatus;
use App\Models\NewsletterSource;
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
        Schema::create('newsletters', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->foreignIdFor(Category::class);
            $table->foreignIdFor(NewsletterSource::class);
            $table->foreignIdFor(NewsletterPublicationStatus::class);
            $table->foreignIdFor(User::class, 'created_by_user_id');
            $table->string('title');
            $table->text('spot');
            $table->longText('content');
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

<?php

use App\Enum\Gallery\VideoGallery\VideoGalleryIsActiveEnum;
use App\Models\Gallery;
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
        Schema::create('video_galleries', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->unsignedBigInteger('created_by_user_id');
            $table->unsignedBigInteger('gallery_id');
            $table->string('video_url');
            $table->string('caption');
            $table->boolean('is_active')->default(VideoGalleryIsActiveEnum::ACTIVE->value);
            $table->bigInteger('order')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('created_by_user_id')
                ->on('users')
                ->references('id');

            $table->foreign('gallery_id')
                ->on('galleries')
                ->references('id')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('video_galleries');
    }
};

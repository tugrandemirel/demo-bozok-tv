<?php

use App\Enum\Gallery\GalleryImage\GalleryImageEnum;
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
        Schema::create('gallery_images', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->unsignedBigInteger('gallery_id');
            $table->unsignedBigInteger('created_by_user_id');
            $table->string('image_name');     // Görselin adı
            $table->string('image_ext');      // Görselin uzantısı (örneğin: jpg, png)
            $table->unsignedBigInteger('size'); // Görselin boyutu (bayt cinsinden)
            $table->string('path');           // Görselin dosya yolu
            $table->string('alt_text')->nullable(); // Görsel için alternatif metin (SEO için)
            $table->integer('width')->nullable();   // Görselin genişliği (piksel cinsinden)
            $table->integer('height')->nullable();  // Görselin yüksekliği (piksel cinsinden)
            $table->string('mime_type');       // Görselin MIME türü (örneğin: image/jpeg)
            $table->boolean('is_active')->default(GalleryImageEnum::ACTIVE->value);
            $table->integer('order')->nullable();
            $table->timestamps();
            $table->softDeletes();

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
        Schema::dropIfExists('gallery_images');
    }
};

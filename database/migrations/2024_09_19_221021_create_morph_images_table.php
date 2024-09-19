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
        Schema::create('morph_images', function (Blueprint $table) {
            $table->id();
            $table->string('image_name');     // Görselin adı
            $table->string('image_ext');      // Görselin uzantısı (örneğin: jpg, png)
            $table->unsignedBigInteger('size'); // Görselin boyutu (bayt cinsinden)
            $table->string('path');           // Görselin dosya yolu
            $table->string('alt_text')->nullable(); // Görsel için alternatif metin (SEO için)
            $table->integer('width')->nullable();   // Görselin genişliği (piksel cinsinden)
            $table->integer('height')->nullable();  // Görselin yüksekliği (piksel cinsinden)
            $table->string('mime_type');       // Görselin MIME türü (örneğin: image/jpeg)
            $table->string('image_type')->nullable(); // Görselin tipi, newsletters tablosu için geçerli
            $table->morphs('imageable');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('morph_images');
    }
};

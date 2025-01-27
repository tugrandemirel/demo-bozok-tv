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
        Schema::table('newsletters', function (Blueprint $table) {
            if (Schema::hasColumn('newsletters', 'is_outstanding')) {
                $table->dropColumn('is_outstanding');
            }
        });

        Schema::create('newsletter_outstandings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("newsletter_id");
            $table->bigInteger("order")->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('newsletter_id')->references('id')->on('newsletters')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('newsletters', function (Blueprint $table) {
            $table->boolean('is_outstanding')->default(NewsletterGeneralEnum::OFF->value)->after("is_main_headline");
        });

        Schema::dropIfExists('newsletter_outstandings');
    }
};

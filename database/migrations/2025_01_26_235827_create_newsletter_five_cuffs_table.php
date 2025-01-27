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
            if (Schema::hasColumn('newsletters', 'is_five_cuff')) {
                $table->dropColumn('is_five_cuff');
            }
        });

        Schema::create('newsletter_five_cuffs', function (Blueprint $table) {
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
            $table->boolean('is_five_cuff')->default(NewsletterGeneralEnum::OFF->value)->after("is_main_headline");
        });

        Schema::dropIfExists('newsletter_five_cuffs');
    }
};

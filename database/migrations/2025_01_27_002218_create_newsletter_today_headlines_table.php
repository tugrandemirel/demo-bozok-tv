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
            if (Schema::hasColumn('newsletters', 'is_today_headline')) {
                $table->dropColumn('is_today_headline');
            }
        });

        Schema::create('newsletter_today_headlines', function (Blueprint $table) {
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
            $table->boolean('is_today_headline')->default(NewsletterGeneralEnum::OFF->value)->after("is_main_headline");
        });

        Schema::dropIfExists('newsletter_today_headlines');
    }
};

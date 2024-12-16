<?php

use App\Enum\Ads\AdsIsActiveEnum;
use App\Models\AdType;
use App\Models\Placement;
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
        Schema::create('ads', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->foreignIdFor(User::class, 'created_by_user_id');
            $table->foreignIdFor(AdType::class);
            $table->foreignIdFor(Placement::class);
            $table->string('url')->nullable();
            $table->text('ad_code')->nullable();
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->boolean('is_active')->default(AdsIsActiveEnum::ACTIVE->value);
            $table->bigInteger('order')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ads');
    }
};

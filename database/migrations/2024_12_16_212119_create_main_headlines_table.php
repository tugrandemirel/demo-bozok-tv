<?php

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
        Schema::create('main_headlines', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->foreignIdFor(User::class, "created_by_user_id");
            $table->morphs("headlineable");
            $table->unsignedBigInteger("order")->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('main_headlines');
    }
};

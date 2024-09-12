<?php

use App\Enum\Category\CategoryHomePageEnum;
use App\Enum\Category\CategoryIsActiveEnum;
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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, 'created_by_user_id')->index();
            $table->unsignedBigInteger('parent_id')->index()->default(0);
            $table->string('name');
            $table->string('slug');
            $table->integer('order')->default(0)->index();
            $table->boolean('is_active')->index()->default(CategoryIsActiveEnum::PASSIVE->value);
            $table->boolean('home_page')->index()->default(CategoryHomePageEnum::PASSIVE->value);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};

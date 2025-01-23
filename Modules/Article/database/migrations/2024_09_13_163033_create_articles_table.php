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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->foreignId('category_id')->constrained('categories');
            $table->string('slug')->unique();
            $table->enum('locale', \Modules\Core\Enums\Locale::getValues())->default(\Modules\Core\Enums\Locale::FA);
            $table->string('image');
            $table->string('thumbnail')->nullable();
            $table->text('summary');
            $table->unsignedSmallInteger('read_time');
            $table->unsignedMediumInteger('likes')->default(0);
            $table->boolean('is_new')->default(false);
            $table->smallInteger('newer_order')->default(0);
            $table->string('alt')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_tags')->nullable();
            $table->string('meta_description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};

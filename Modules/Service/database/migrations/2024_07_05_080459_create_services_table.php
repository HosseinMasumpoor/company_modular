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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('icon', 100)->nullable();
            $table->enum('locale', \Modules\Core\Enums\Locale::getValues())->default(\Modules\Core\Enums\Locale::FA);
            $table->string('slug')->unique();
            $table->text('summary');
            $table->string('image');
            $table->text('body')->nullable();
            $table->string('slogan');
            $table->tinyInteger('order')->default(0);
            $table->string('meta_title')->nullable();
            $table->string('meta_tags')->nullable();
            $table->text('meta_description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};

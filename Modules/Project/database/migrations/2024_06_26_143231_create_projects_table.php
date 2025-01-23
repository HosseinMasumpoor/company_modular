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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->enum('locale', \Modules\Core\Enums\Locale::getValues())->default(\Modules\Core\Enums\Locale::FA);
            $table->string('image');
            $table->text('summary');
            $table->boolean('is_ready')->default(false);
            $table->string('link')->nullable();
            $table->smallInteger('working_days');
            $table->text('tech_description')->nullable();
            $table->text('feature_description')->nullable();
            $table->string('presentation_file')->nullable();
            $table->text('presentation_des')->nullable();
            $table->string('alt')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_tags')->nullable();
            $table->text('meta_description')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};

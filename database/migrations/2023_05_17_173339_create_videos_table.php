<?php

use App\Models\AgeCategory;
use App\Models\Category;
use App\Models\Genre;
use App\Models\Rubric;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->id();

            $table->timestamps();
            $table->softDeletes();

            $table->boolean('is_active')->default(true)->nullable();

            $table->foreignId('author_id')->constrained('users');
            $table->foreignIdFor(Rubric::class)->nullable()->constrained()->nullOnDelete();
            $table->foreignIdFor(Genre::class)->nullable()->constrained()->nullOnDelete();
            $table->foreignIdFor(Category::class)->nullable()->constrained()->nullOnDelete();
            $table->foreignIdFor(AgeCategory::class)->nullable()->constrained()->nullOnDelete();

            $table->string('title_ru')->nullable();
            $table->string('title_kz')->nullable();
            $table->string('title_en')->nullable();

            $table->string('cover')->nullable();
            $table->string('subtitle')->nullable();
            $table->integer('film_year')->nullable();
            $table->date('premiere_date')->nullable();

            $table->text('description_ru')->nullable();
            $table->text('description_kz')->nullable();
            $table->text('description_en')->nullable();

            $table->string('seo_title_ru')->nullable();
            $table->string('seo_title_kz')->nullable();
            $table->string('seo_title_en')->nullable();

            $table->string('seo_keywords_ru')->nullable();
            $table->string('seo_keywords_kz')->nullable();
            $table->string('seo_keywords_en')->nullable();

            $table->text('seo_description_ru')->nullable();
            $table->text('seo_description_kz')->nullable();
            $table->text('seo_description_en')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('videos');
    }
};

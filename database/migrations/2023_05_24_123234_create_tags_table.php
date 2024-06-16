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
        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->timestamps();
        });

        Schema::create('video_tags', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('video_id')->nullable();
            $table->unsignedBigInteger('tag_id')->nullable();
            $table->timestamps();

            $table->foreign('video_id')->references('id')->on('videos')->nullOnDelete();
            $table->foreign('tag_id')->references('id')->on('tags')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('video_tags');
        Schema::dropIfExists('tags');
    }
};

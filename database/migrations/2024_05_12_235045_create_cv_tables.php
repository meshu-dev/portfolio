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
        Schema::create('profile_details', function (Blueprint $table) {
            $table->id();
            $table->string('key');
            $table->string('value');
        });

        Schema::create('profile_links', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('url');
            $table->string('image_url');
        });

        Schema::create('skill_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });

        Schema::create('skills', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('skill_type_id');
            $table->string('name');

            $table->foreign('skill_type_id')->references('id')->on('skill_types');
        });

        Schema::create('work_experiences', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('location');
            $table->string('date');
            $table->string('description');
            $table->json('responsibilities');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile_details');
        Schema::dropIfExists('profile_links');
        Schema::dropIfExists('skills');
        Schema::dropIfExists('skill_types');
        Schema::dropIfExists('work_experiences');
    }
};

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
        Schema::create('texts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('value');
        });

        Schema::create('icons', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('url');
            $table->string('image_url');
        });

        Schema::create('technologies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });

        Schema::create('skills', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });

        Schema::create('skill_technologies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('skill_id');
            $table->unsignedBigInteger('technology_id');

            $table->foreign('skill_id')->references('id')->on('skills');
            $table->foreign('technology_id')->references('id')->on('technologies');
        });

        Schema::create('work_experiences', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('company');
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
        Schema::dropIfExists('texts');
        Schema::dropIfExists('icons');
        Schema::dropIfExists('technologies');
        Schema::dropIfExists('skills');
        Schema::dropIfExists('skill_technologies');
        Schema::dropIfExists('work_experiences');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('texts', function (Blueprint $table) {
            $table->uuid('id');
            $table->unsignedBigInteger('user_id');
            $table->string('name');
            $table->text('value');

            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::create('profiles', function (Blueprint $table) {
            $table->uuid('id');
            $table->unsignedBigInteger('user_id');
            $table->string('intro');
            $table->string('location');

            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::create('technologies', function (Blueprint $table) {
            $table->uuid('id');
            $table->unsignedBigInteger('user_id');
            $table->string('name');

            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::create('skills', function (Blueprint $table) {
            $table->uuid('id');
            $table->unsignedBigInteger('user_id');
            $table->string('name');

            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::create('skill_technologies', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('skill_id');
            $table->foreignUuid('technology_id');

            //$table->foreign('skill_id')->references('id')->on('skills');
            //$table->foreign('technology_id')->references('id')->on('technologies');
        });

        Schema::create('work_experiences', function (Blueprint $table) {
            $table->uuid('id');
            $table->unsignedBigInteger('user_id');
            $table->string('title');
            $table->string('company');
            $table->string('location');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->string('description');
            $table->json('responsibilities');
            $table->boolean('active');

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('texts');
        Schema::dropIfExists('technologies');
        Schema::dropIfExists('skills');
        Schema::dropIfExists('skill_technologies');
        Schema::dropIfExists('work_experiences');
    }
};

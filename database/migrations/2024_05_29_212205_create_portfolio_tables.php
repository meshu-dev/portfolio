<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->text('url');
        });

        Schema::create('repositories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('url');
        });

        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->string('url');
            $table->smallInteger('order')->default(0);
        });

        Schema::create('project_repositories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id');
            $table->unsignedBigInteger('repository_id');

            $table->foreign('project_id')->references('id')->on('projects');
            $table->foreign('repository_id')->references('id')->on('repositories');
        });

        Schema::create('project_technologies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id');
            $table->unsignedBigInteger('technology_id');

            $table->foreign('project_id')->references('id')->on('projects');
            $table->foreign('technology_id')->references('id')->on('technologies');
        });

        Schema::create('project_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id');
            $table->unsignedBigInteger('image_id');

            $table->foreign('project_id')->references('id')->on('projects');
            $table->foreign('image_id')->references('id')->on('images');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        Schema::dropIfExists('images');
        Schema::dropIfExists('repositories');
        Schema::dropIfExists('projects');
        Schema::dropIfExists('project_repositories');
        Schema::dropIfExists('project_technologies');
        Schema::dropIfExists('project_images');

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
};

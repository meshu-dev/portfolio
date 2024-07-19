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
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->string('name');
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

        Schema::create('project_files', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id');
            $table->unsignedBigInteger('file_id');

            $table->foreign('project_id')->references('id')->on('projects');
            $table->foreign('file_id')->references('id')->on('files');
        });

        Schema::create('types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });

        Schema::create('sites', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('url');
        });

        Schema::create('site_files', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('type_id');
            $table->unsignedBigInteger('site_id');
            $table->unsignedBigInteger('file_id');

            $table->foreign('type_id')->references('id')->on('types');
            $table->foreign('site_id')->references('id')->on('sites');
            $table->foreign('file_id')->references('id')->on('files');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        Schema::dropIfExists('files');
        Schema::dropIfExists('repositories');
        Schema::dropIfExists('projects');
        Schema::dropIfExists('project_repositories');
        Schema::dropIfExists('project_technologies');
        Schema::dropIfExists('project_files');
        Schema::dropIfExists('types');
        Schema::dropIfExists('sites');
        Schema::dropIfExists('site_files');

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
};

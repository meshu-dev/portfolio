<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('name');
            $table->text('url');
        });

        Schema::create('intros', function (Blueprint $table) {
            $table->uuid('id');
            $table->unsignedBigInteger('user_id');
            $table->string('line1');
            $table->string('line2');

            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::create('abouts', function (Blueprint $table) {
            $table->uuid('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('file_id')->nullable();
            $table->text('text');

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('file_id')->references('id')->on('files');
        });

        Schema::create('repositories', function (Blueprint $table) {
            $table->uuid('id');
            $table->unsignedBigInteger('user_id');
            $table->string('name');
            $table->string('url');

            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::create('projects', function (Blueprint $table) {
            $table->uuid('id');
            $table->unsignedBigInteger('user_id');
            $table->string('name');
            $table->string('description');
            $table->string('url');
            $table->smallInteger('order')->default(0);

            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::create('project_repositories', function (Blueprint $table) {
            $table->id()->primary();
            $table->foreignUuid('project_id');
            $table->foreignUuid('repository_id');

            //$table->foreignUuid('project_id')->references('id')->on('projects');
            //$table->foreignUuid('repository_id')->references('id')->on('repositories');
        });

        Schema::create('project_technologies', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('project_id');
            $table->foreignUuid('technology_id');

            //$table->foreignUuid('project_id')->references('id')->on('projects');
            //$table->foreignUuid('technology_id')->references('id')->on('technologies');
        });

        Schema::create('project_files', function (Blueprint $table) {
            $table->id()->primary();
            $table->foreignUuid('project_id');
            $table->unsignedBigInteger('file_id');

            //$table->foreignUuid('project_id')->references('id')->on('projects');
            $table->foreign('file_id')->references('id')->on('files');
        });

        Schema::create('types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });

        Schema::create('sites', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreignUuid('file_id')->nullable();
            $table->string('name');
            $table->string('url');

            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::create('type_sites', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('type_id');
            $table->foreignUuid('site_id');
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

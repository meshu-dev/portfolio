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
        Schema::table('skill_technologies', function (Blueprint $table) {
            $table->dropForeign(['skill_id']);
            $table->dropForeign(['technology_id']);
        });

        Schema::table('project_technologies', function (Blueprint $table) {
            $table->dropForeign(['technology_id']);
        });

        Schema::table('skills',           fn (Blueprint $table) => $table->uuid('id')->change());
        Schema::table('technologies',     fn (Blueprint $table) => $table->uuid('id')->change());
        Schema::table('texts',            fn (Blueprint $table) => $table->uuid('id')->change());
        Schema::table('work_experiences', fn (Blueprint $table) => $table->uuid('id')->change());

        Schema::table('skill_technologies', function (Blueprint $table) {
            $table->uuid('skill_id')->change();
            $table->uuid('technology_id')->change();

            $table->foreign('skill_id')->references('id')->on('skills');
            $table->foreign('technology_id')->references('id')->on('technologies');
        });

        Schema::table('project_technologies', function (Blueprint $table) {
            $table->uuid('technology_id')->change();
            $table->foreign('technology_id')->references('id')->on('technologies');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('skill_technologies', function (Blueprint $table) {
            $table->dropForeign(['skill_id']);
            $table->dropForeign(['technology_id']);
        });

        Schema::table('project_technologies', function (Blueprint $table) {
            $table->dropForeign(['technology_id']);
        });

        Schema::table('skills',           fn (Blueprint $table) => $table->id('id')->change());
        Schema::table('technologies',     fn (Blueprint $table) => $table->id('id')->change());
        Schema::table('texts',            fn (Blueprint $table) => $table->id('id')->change());
        Schema::table('work_experiences', fn (Blueprint $table) => $table->id('id')->change());

        Schema::table('skill_technologies', function (Blueprint $table) {
            $table->id('skill_id')->change();
            $table->id('technology_id')->change();

            $table->foreign('skill_id')->references('id')->on('skills');
            $table->foreign('technology_id')->references('id')->on('technologies');
        });

        Schema::table('project_technologies', function (Blueprint $table) {
            $table->id('technology_id')->change();
            $table->foreign('technology_id')->references('id')->on('technologies');
        });
    }
};

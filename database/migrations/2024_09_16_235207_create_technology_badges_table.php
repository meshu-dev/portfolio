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
        Schema::create('technology_badges', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('technology_id');
            $table->string('icon');
            $table->string('icon_colour');
            $table->string('logo');
            $table->string('logo_colour');

            $table->foreign('technology_id')->references('id')->on('technologies');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('technology_badges');
    }
};

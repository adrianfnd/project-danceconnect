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
        Schema::create('classes', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->string('name');
            $table->timestamp('start_at');
            $table->integer('quota');
            $table->uuid('tutor_id');
            $table->foreign('tutor_id')->references('uuid')->on('tutors');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classes');
    }
};

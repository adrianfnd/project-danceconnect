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
        Schema::create('tutor_schedules', function (Blueprint $table) {
             $table->id();
            $table->uuid('tutor_id');
            $table->foreign('tutor_id')->references('uuid')->on('tutors');
            $table->uuid('user_id');
            $table->foreign('user_id')->references('uuid')->on('users');
            $table->timestamp('booked_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tutor_schedules');
    }
};

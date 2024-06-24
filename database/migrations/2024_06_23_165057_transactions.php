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
        Schema::create('transactions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->uuid('studio_id')->nullable();
            $table->foreign('studio_id')->references('id')->on('studios');
            $table->unsignedBigInteger('studio_schedule_id')->nullable();
            $table->foreign('studio_schedule_id')->references('id')->on('studio_schedules');
            $table->uuid('tutor_id')->nullable();
            $table->foreign('tutor_id')->references('id')->on('tutors');
            $table->unsignedBigInteger('tutor_scheduled_id')->nullable();
            $table->foreign('tutor_scheduled_id')->references('id')->on('tutor_schedules');
            $table->uuid('class_id')->nullable();
            $table->foreign('class_id')->references('id')->on('classes');
            $table->string('xendit_log_id')->nullable();
            $table->foreign('xendit_log_id')->references('id')->on('xendit_logs');
            $table->string('status');
            $table->timestamps();    
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};

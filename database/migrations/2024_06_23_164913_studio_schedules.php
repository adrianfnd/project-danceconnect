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
        Schema::create('studio_schedules', function (Blueprint $table) {
            $table->id();
            $table->uuid('studio_id');
            $table->foreign('studio_id')->references('uuid')->on('studios');
            $table->uuid('user_id');
            $table->foreign('user_id')->references('uuid')->on('users');
            $table->timestamp('booked_at');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('studio_schedules');
    }
};

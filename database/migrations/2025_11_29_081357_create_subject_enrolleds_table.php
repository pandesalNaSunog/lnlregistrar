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
        Schema::create('subject_enrolleds', function (Blueprint $table) {
            $table->id();
            $table->integer('enrollment_id');
            $table->integer('subject_id');
            $table->integer('prelim');
            $table->integer('midterm');
            $table->integer('semi_final');
            $table->integer('final');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subject_enrolleds');
    }
};

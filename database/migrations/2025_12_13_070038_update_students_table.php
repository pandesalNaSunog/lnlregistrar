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
        Schema::table('students', function(Blueprint $table){
            $table->string('first_generation_student')->nullable();
            $table->string('member_of_ip')->nullable();
            $table->string('ip_group')->nullable();
            $table->string('solo_parent_student')->nullable();
            $table->string('student_with_solo_parent')->nullable();
            $table->string('pwd_student')->nullable();
            $table->string('student_with_pwd_parent')->nullable();
            $table->string('senior_citizen_student')->nullable();
            $table->string('student_with_senior_citizen_parent')->nullable();
            $table->string('student_with_ofw_parent')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        
    }
};

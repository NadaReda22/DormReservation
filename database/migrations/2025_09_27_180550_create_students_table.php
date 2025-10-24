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
        Schema::create('students', function (Blueprint $table) {
        $table->id();
        $table->string('student_id', 20)->unique(); // generated student ID
        $table->string('name', 256);
        $table->string('phone', 20)->nullable();
        $table->string('email', 256)->unique();
        $table->string('id_image', 256);
        $table->string('verification_report', 256);
        $table->string('home_city', 256);
        $table->string('school_year', 20);
        $table->boolean('verified')->default(false);   // admin approved him as a student
        $table->boolean('confirmed')->default(false);  // has a confirmed room & settle in
        $table->foreignId('room_id')->nullable()->constrained('rooms')->onDelete('set null'); // assigned room
        $table->foreignId('priority_one')->nullable()->constrained('rooms')->onDelete('set null'); // first choice
        $table->foreignId('priority_two')->nullable()->constrained('rooms')->onDelete('set null'); // second choice
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};

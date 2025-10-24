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
        Schema::create('student_room', function (Blueprint $table) {
        $table->id();
        $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
        $table->foreignId('room_id')->constrained('rooms')->onDelete('cascade');
        $table->enum('status', ['pending', 'confirmed'])->default('pending');
        $table->unsignedTinyInteger('priority')->nullable(); // 1 = first choice, 2 = second, 3 = third
        $table->timestamp('reserved_at')->nullable();        // when student reserved
        $table->timestamp('confirmed_at')->nullable();       // when payment confirmed
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_room');
    }
};

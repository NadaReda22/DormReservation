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
        Schema::table('student_room', function (Blueprint $table) {
     $table->enum('status', ['pending', 'confirmed'])->default('pending')->change();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('student_room', function (Blueprint $table) {
     $table->enum('status', ['pending', 'confirmed','removed'])->default('pending')->change();

        });
    }
};

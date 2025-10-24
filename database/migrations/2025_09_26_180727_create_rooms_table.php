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
        Schema::create('rooms', function (Blueprint $table) {
        $table->id();
        $table->string('room_id', 20)->unique();  // Example: A101, B202
        $table->unsignedInteger('capacity');         // max students allowed
        $table->enum('status', ['empty', 'pending', 'confirmed'])->default('empty');
        $table->unsignedInteger('confirmed_count')->default(0);
        $table->unsignedInteger('pending_count')->default(0);
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};

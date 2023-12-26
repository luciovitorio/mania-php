<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name', 255);
            $table->integer('piece_quantity');
            $table->integer('simple_piece_quantity');
            $table->integer('difficult_piece_quantity');
            $table->decimal('simple_piece_value', 20, 2);
            $table->decimal('difficult_piece_value', 20, 2);
            $table->decimal('additional_simple_piece_value', 20, 2);
            $table->decimal('additional_difficult_piece_value', 20, 2);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plans');
    }
};

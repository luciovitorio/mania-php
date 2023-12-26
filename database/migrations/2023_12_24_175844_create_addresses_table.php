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
        Schema::create('addresses', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->nullable()->references('id')->on('users');
            $table->foreignUuid('branch_id')->nullable()->references('id')->on('branches');
            $table->foreignUuid('client_id')->nullable()->references('id')->on('clients');
            $table->string('cep', 50);
            $table->string('street', 255);
            $table->string('number', 50);
            $table->string('complement', 50)->nullable();
            $table->string('district', 255);
            $table->string('city', 255);
            $table->string('state', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};

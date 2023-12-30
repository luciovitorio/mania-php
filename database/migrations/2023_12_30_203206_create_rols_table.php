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
        Schema::create('rols', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('branch_id')->nullable()->references('id')->on('branches');
            $table->foreignUuid('client_id')->nullable()->references('id')->on('clients');
            $table->foreignUuid('user_id')->nullable()->references('id')->on('users');
            $table->uuid('link');
            $table->dateTime('production_start_date')->nullable();
            $table->dateTime('delivery_date')->nullable();
            $table->dateTime('production_end_date')->nullable();
            $table->dateTime('finished_at')->nullable();
            $table->boolean('is_hanger')->default(false);
            $table->integer('hanger_quantity')->nullable();
            $table->string('status')->default('inicio');
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rols');
    }
};

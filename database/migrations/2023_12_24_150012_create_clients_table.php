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
        Schema::create('clients', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('branch_id')->references('id')->on('branches');
            $table->foreignUuid('plan_id')->references('id')->on('plans');
            $table->string('name', 255);
            $table->string('cpf', 16)->nullable();
            $table->string('rg', 20)->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('email')->nullable();
            $table->string('home_phone', 20)->nullable();
            $table->string('cell_phone', 20)->nullable();
            $table->string('collection_frequency')->default('AVULSO');
            $table->string('collection_day')->default('SEGUNDA')->nullable();
            $table->time('collection_time')->default('00:00:00')->nullable();
            $table->string('delivery_day')->default('SEGUNDA')->nullable();
            $table->time('delivery_time')->default('00:00:00')->nullable();
            $table->date('collection_start')->nullable();
            $table->text('description')->nullable();
            $table->boolean('delivery_fee')->default(false);
            $table->decimal('delivery_amount', 20, 2)->nullable();
            $table->integer('due_date')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('placed_by');
            $table->unsignedBigInteger('fulfilled_by')->nullable();
            $table->unsignedBigInteger('coffee_bean_id');
            $table->decimal('quantity_kg', 10, 2);
            $table->decimal('price_total', 10, 2);
            $table->enum('status', ['pending', 'processing', 'shipped', 'delivered', 'cancelled'])->default('pending');
            $table->timestamps();

            $table->foreign('placed_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('fulfilled_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('coffee_bean_id')->references('id')->on('coffee_beans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};

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
        Schema::create('inventory', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('supply_center_id');
            $table->unsignedBigInteger('coffee_bean_id');
            $table->decimal('quantity_kg', 10, 2);
            $table->timestamps();

            $table->foreign('supply_center_id')->references('id')->on('supply_centers')->onDelete('cascade');
            $table->foreign('coffee_bean_id')->references('id')->on('coffee_beans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventories');
    }
};

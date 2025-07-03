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
        Schema::create('coffee_beans', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['Arabica', 'Robusta']);
            $table->enum('form', ['raw', 'roasted', 'ground', 'packaged']);
            $table->string('quality_grade');
            $table->string('origin');
            $table->decimal('price_per_kg', 8, 2);
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coffee_beans');
    }
};

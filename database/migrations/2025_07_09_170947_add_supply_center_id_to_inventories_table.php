<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('inventories', function (Blueprint $table) {
            $table->unsignedBigInteger('supply_center_id')->nullable()->after('id');

            // If supply_centers table exists and you're using foreign key constraints:
            $table->foreign('supply_center_id')->references('id')->on('supply_centers')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('inventories', function (Blueprint $table) {
            $table->dropForeign(['supply_center_id']);
            $table->dropColumn('supply_center_id');
        });
    }
};

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
        Schema::create('electrical_equipments_to_orders', function (Blueprint $table) {
            $table->unsignedBigInteger('electrical_equipment_id');
            $table->unsignedBigInteger('electrical_equipment_order_id');
            $table->primary(['electrical_equipment_id','electrical_equipment_order_id']);
            $table->foreign('electrical_equipment_id')->references('id')->on('electrical_equipments')->onDelete('cascade');
            $table->foreign('electrical_equipment_order_id')->references('id')->on('electrical_equipment_orders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('electrical_equipments_to_orders');
    }
};

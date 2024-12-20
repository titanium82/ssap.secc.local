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
        Schema::create('electrical_equipments', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();       //tên thiết bị
            $table->string('unit');                 //đơn vị tính
            $table->double('cost')->nullable();     //giá nhập thiết bị
            $table->double('price')->nullable();    //giá bán thiết bị
            $table->text('image')->nullable();      //hình ảnh thiết bị
            $table->unsignedBigInteger('electrical_equipment_type_id')->nullable();
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->unsignedBigInteger('warehouse_id')->nullable();
            $table->foreign('admin_id')->references('id')->on('admins')->restrictOnDelete();
            $table->foreign('electrical_equipment_type_id')->references('id')->on('electrical_equipment_types')->restrictOnDelete();
            $table->foreign('warehouse_id')->references('id')->on('warehouse')->restrictOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('electrical_equipments');
    }
};

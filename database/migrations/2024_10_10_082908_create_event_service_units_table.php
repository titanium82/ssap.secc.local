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
        Schema::create('event_service_units', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_id');
            $table->unsignedBigInteger('event_service_types_id');
            $table->string('unit');
            $table->string('dimensions');
            $table->string('banner_sides'); //trạn thái một mặt hoặc 2 mặt của banner
            $table->string('vertical_banner'); //banner dọc
            $table->string('horizontal_banner'); //banner ngang
            $table->string('led_locations'); //vị trí cổng led
            $table->string('desc');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_service_units');
    }
};

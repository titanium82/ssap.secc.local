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
        Schema::create('exhibition_events', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_id');
            $table->unsignedBigInteger('exhibition_location_id');   //Vị trí tổ chức sự kiện
            $table->unsignedBigInteger('customer_id');
            $table->string('name'); //tên sự kiện
            $table->string('shortname');    //tên viết tắt sự kiện
            $table->dateTime('start_day');  //Ngày bắt đầu sự kiện
            $table->dateTime('end_day');    //Ngày kết thúc sự kiện
            $table->string('event_operator'); //Người vận hành sự kiện
            $table->foreign('admin_id')->references('id')->on('admins')->restrictOnDelete();
            $table->foreign('exhibition_location_id')->references('id')->on('exhibition_locations')->restrictOnDelete();
            $table->foreign('customer_id')->references('id')->on('customers')->restrictOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exhibition_events');
    }
};

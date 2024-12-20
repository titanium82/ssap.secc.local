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
        Schema::create('electrical_equipment_orders', function (Blueprint $table) {
            $table->id();
            $table->char('code',50)->unique()->nullable();  //Số phiếu đăng ký thiết bị điện.
            $table->unsignedBigInteger('admin_id');                 //người làm phiếu
            $table->unsignedBigInteger('customer_id');              //khách hàng
            $table->unsignedBigInteger('approved_by')->nullable();  // người duyệt
            $table->unsignedBigInteger('exhibition_event_id');      // sự kiện triển lãm
            $table->string('booth_no');                             //gian hàng số
            $table->double('discount');                             //chiết khấu 10,20,30%
            $table->double('vat');                                  //thuế VAT 10%
            $table->double('amount');                               //thành tiền
            $table->double('total_amount');                         //tổng tiền
            $table->string('contact_fullname')->nullable();         //tên người liên hệ trực tiếp
            $table->string('contact_phone')->nullable();            //số đt người liên hệ trực tiếp
            $table->tinyInteger('status');                          // trạng thái triển khai phiếu đăng ký
            $table->timestamps();
            $table->foreign('admin_id')->references('id')->on('admins')->restrictOnDelete();
            $table->foreign('customer_id')->references('id')->on('customers')->restrictOnDelete();
            $table->foreign('exhibition_event_id')->references('id')->on('exhibition_events')->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('electrical_equipment_orders');
    }
};

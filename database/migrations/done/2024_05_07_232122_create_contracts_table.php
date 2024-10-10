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
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->char('code', 50)->unique()->nullable(); // so hop dong khach tu nhap
            $table->unsignedBigInteger('admin_id');
            $table->unsignedBigInteger('contract_type_id');
            $table->unsignedBigInteger('customer_id');
            $table->string('name')->nullable();
            $table->tinyInteger('status');
            $table->date('day_begin')->nullable();
            $table->date('day_end')->nullable();
            $table->unsignedBigInteger('currency_id');
            $table->double('total_amount')->default(0);
            $table->double('deposit')->default(0);
            $table->tinyInteger('payment_method');
            $table->json('annex')->nullable(); // file phu luc
            $table->json('files')->nullable(); // file hop dong
            $table->text('note')->nullable();
            $table->timestamps();
            $table->foreign('admin_id')->references('id')->on('admins')->restrictOnDelete();
            $table->foreign('contract_type_id')->references('id')->on('contract_types')->restrictOnDelete();
            $table->foreign('customer_id')->references('id')->on('customers')->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contracts');
    }
};

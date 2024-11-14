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
        Schema::create('contract_payments_share_admins', function (Blueprint $table) {
            $table->unsignedBigInteger('contract_payment_id');
            $table->unsignedBigInteger('admin_id');
            $table->primary(['contract_payment_id', 'admin_id']);
            $table->foreign('contract_payment_id')->references('id')->on('contract_payments')->onDelete('cascade');
            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contract_payments_share_admins');
    }
};

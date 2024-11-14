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
        Schema::create('contract_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_id');
            $table->unsignedBigInteger('contract_id');
            $table->unsignedBigInteger('approved_by')->nullable();
            $table->date('expired_at');
            $table->tinyInteger('period');
            $table->double('amount')->default(0);
            $table->tinyInteger('status');
            $table->json('license')->nullable();
            $table->text('file_send_mail')->nullable();
            $table->timestamps();
            $table->foreign('admin_id')->references('id')->on('admins')->restrictOnDelete();
            $table->foreign('contract_id')->references('id')->on('contracts')->restrictOnDelete();
            $table->foreign('approved_by')->references('id')->on('admins')->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contract_payments');
    }
};

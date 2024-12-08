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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->unsignedBigInteger('customer_type_id')->nullable();
            $table->string('fullname')->nullable();
            $table->string('short_name')->nullable();
            $table->string('phone')->nullable();
            $table->char('gender', 20)->nullable();
            $table->string('fax')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('taxcode')->unique()->nullable();
            $table->string('logo')->nullable();
            $table->string('address')->nullable();
            $table->string('address_vat')->nullable();
            $table->string('delegate')->nullable();
            $table->string('website')->nullable();
            $table->json('files')->nullable();
            $table->text('note')->nullable();
            $table->timestamps();
            $table->foreign('customer_type_id')->references('id')->on('customer_types')->restrictOnDelete();
            $table->foreign('admin_id')->references('id')->on('admins')->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};

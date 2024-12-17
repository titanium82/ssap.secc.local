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
        Schema::create('customer_contacts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_id');
            $table->unsignedBigInteger('customer_id');
            $table->string('fullname')->nullable();
            $table->string('phone')->nullable();
            $table->string('phone_second')->nullable();
            $table->string('phone_third')->nullable();
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->string('avatar')->nullable();
            $table->date('birthday')->nullable();
            $table->char('gender', 20)->nullable();
            $table->string('position')->nullable();
            $table->text('desc')->nullable();
            $table->timestamps();
            $table->foreign('admin_id')->references('id')->on('admins')->restrictOnDelete();
            $table->foreign('customer_id')->references('id')->on('customers')->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_contacts');
    }
};

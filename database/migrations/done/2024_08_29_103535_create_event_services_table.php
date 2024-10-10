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
        Schema::create('event_services', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_id');
            $table->unsignedBigInteger('event_service_type_id')->nullable();
            $table->string('name')->nullable();
            $table->string('unit')->nullable();
            $table->double('price')->nullable();
            $table->string('desc')->nullable();
            $table->timestamps();
            $table->foreign('event_service_type_id')->references('id')->on('event_service_types')->restrictOnDelete();
            $table->foreign('admin_id')->references('id')->on('admins')->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_services');
    }
};

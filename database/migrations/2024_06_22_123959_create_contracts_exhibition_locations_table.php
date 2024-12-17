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
        Schema::create('contracts_exhibition_locations', function (Blueprint $table) {
            $table->unsignedBigInteger('contract_id');
            $table->unsignedBigInteger('exhibition_location_id');
            $table->primary(['contract_id', 'exhibition_location_id']);
            $table->foreign('contract_id')->references('id')->on('contracts')->onDelete('cascade');
            $table->foreign('exhibition_location_id')->references('id')->on('exhibition_locations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contracts_exhibition_locations');
    }
};

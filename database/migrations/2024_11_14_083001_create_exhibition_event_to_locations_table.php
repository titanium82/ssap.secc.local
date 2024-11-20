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
        Schema::create('exhibition_event_to_locations', function (Blueprint $table) {
            $table->unsignedBigInteger('exhibition_location_id');
            $table->unsignedBigInteger('exhibition_event_id');
            $table->primary(['exhibition_location_id','exhibition_event_id']);
            $table->foreign('exhibition_location_id')->references('id')->on('exhibition_locations')->onDelete('cascade');
            $table->foreign('exhibition_event_id')->references('id')->on('exhibition_events')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exhibition_event_to_locations');
    }
};

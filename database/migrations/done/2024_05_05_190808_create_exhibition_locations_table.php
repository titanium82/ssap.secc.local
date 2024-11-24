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
        Schema::create('exhibition_locations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_id');
            $table->string('fullname');
            $table->float('stretch')->nullable();
            $table->string('location')->default(0);
            $table->string('classroom')->nullable();
            $table->string('theater')->nullable();
            $table->integer('screen_projector')->nullable();
            $table->string('sound')->nullable();
            $table->string('light')->nullable();
            $table->string('wifi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exhibition_location');
    }
};

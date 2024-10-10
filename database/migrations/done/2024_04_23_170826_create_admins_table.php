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
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->char('username', 100)->unique();
            $table->string('fullname')->nullable();
            $table->char('phone', 20)->unique()->nullable();
            $table->char('email', 100)->unique()->nullable();
            $table->date('birthday')->nullable();
            $table->char('gender', 20)->nullable();
            $table->text('avatar')->nullable();
            $table->tinyInteger('status');
            $table->boolean('is_superadmin')->default(false);
            $table->json('access_route_names')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};

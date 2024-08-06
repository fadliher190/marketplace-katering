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
        Schema::create('user_has_merchants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->index();
            $table->unsignedBigInteger('merchant_id')->index();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('merchant_id')->references('id')->on('merchants');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_has_merchants');
    }
};

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
        Schema::create('merchant_has_addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('merchant_id')->index();
            $table->string('phone', 100);
            $table->longText('address');
            $table->timestamps();

            $table->foreign('merchant_id')->references('id')->on('merchants');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('merchant_has_addresses');
    }
};

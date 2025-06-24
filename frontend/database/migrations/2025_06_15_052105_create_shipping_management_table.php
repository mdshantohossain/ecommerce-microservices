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
        Schema::create('shipping_management', function (Blueprint $table) {
            $table->id();
            $table->string('inside_dhaka_delivery_charge');
            $table->string('outside_dhaka_delivery_charge');
            $table->string('shipping_product_delivery_charge');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipping_management');
    }
};

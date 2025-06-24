<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->float('order_total');
            $table->text('order_date');
            $table->text('order_timestamp');
            $table->tinyInteger('order_status')->default(0)->comment("0: Pending, 1: Shipped, 2: Delivered, 3: Canceled, 4: Processing");
            $table->text('delivery_charge')->nullable();
            $table->text('delivery_charge_status')->nullable();
            $table->text('delivery_address');
            $table->text('delivery_date')->nullable();
            $table->text('delivery_status')->nullable();
            $table->text('delivery_timestamp')->nullable();
            $table->text('delivery_method')->nullable();
            $table->tinyInteger('payment_method');
            $table->tinyInteger('payment_status')->nullable()->comment('0: Pending, 1: Success, 2: Failed');
            $table->text('payment_timestamp')->nullable();
            $table->text('payment_date')->nullable();
            $table->string('currency')->nullable();
            $table->integer('transaction_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};

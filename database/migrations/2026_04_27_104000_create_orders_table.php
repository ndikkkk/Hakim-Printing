<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::create('orders', function (Blueprint $table) {
        $table->id();
        $table->string('order_number')->unique();
        $table->foreignId('user_id')->nullable()->constrained()->cascadeOnDelete(); // Jika nanti pakai login user
        $table->foreignId('product_id')->constrained()->cascadeOnDelete();
        $table->integer('quantity')->default(1);
        $table->integer('total_weight')->comment('dalam gram, untuk RajaOngkir');
        $table->integer('shipping_cost')->nullable();
        $table->integer('total_price')->nullable();
        $table->string('payment_status')->default('pending'); // pending, success, failed
        $table->string('snap_token')->nullable(); // Untuk Midtrans
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
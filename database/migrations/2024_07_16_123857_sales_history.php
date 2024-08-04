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
        Schema::create('sales_histories', function (Blueprint $table) {
            $table->id('sales_history_id');
            $table->foreignId('product_id')->references('product_id')->on('products');
            $table->foreignId('user_id')->references('user_id')->on('users');
            $table->foreignId('outlet_id')->references('outlet_id')->on('outlets');
            $table->foreignId('pesanan_id')->references('pesanan_id')->on('pesanans');
            $table->integer("quantity");
            $table->integer("product_price");
            $table->integer("total_price");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_histories');
    }
};

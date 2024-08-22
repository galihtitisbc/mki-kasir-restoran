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
        Schema::create('pesanan_product', function (Blueprint $table) {
            $table->foreignId('pesanan_id')->references('pesanan_id')->on('pesanans');
            $table->foreignId('product_id')->references('product_id')->on('products');
            $table->integer('qty');
            $table->integer('harga');
            $table->integer('total');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};

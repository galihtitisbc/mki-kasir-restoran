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
        Schema::create('bahan_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->references('product_id')->on('products');
            $table->foreignId('bahan_id')->references('bahan_id')->on('bahans');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bahan_products');
    }
};

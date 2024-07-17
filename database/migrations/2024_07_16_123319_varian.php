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
        Schema::create('varians', function (Blueprint $table) {
            $table->id('varian_id');
            $table->foreignId('product_id')->references('product_id')->on('products');
            $table->foreignId('meja_id')->references('meja_id')->on('mejas');
            $table->string("varian_name");
            $table->string("price");
            $table->string("stock");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('varians');
    }
};

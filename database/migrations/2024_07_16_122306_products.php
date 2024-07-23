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
        Schema::create('products', function (Blueprint $table) {
            $table->id('product_id');
            $table->foreignId('user_id')->references('user_id')->on('users');
            $table->foreignId('supplier_id')->references('supplier_id')->on('suppliers')->nullable(true);
            $table->string("slug");
            $table->string("product_name");
            $table->integer("price");
            $table->boolean("status")->default(0);
            $table->integer("stock")->default(0);
            $table->string("gambar");
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

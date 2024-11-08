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
            $table->string('product_code')->unique();
            $table->foreignId('user_id')->references('user_id')->on('users');
            $table->string("slug")->nullable()->unique();
            $table->string("product_name");
            $table->integer("price");
            $table->boolean("status")->default(false);
            $table->boolean("is_food")->default(true);
            $table->integer("stock")->nullable();
            $table->string("gambar")->nullable();
            $table->string("barcode")->nullable();
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

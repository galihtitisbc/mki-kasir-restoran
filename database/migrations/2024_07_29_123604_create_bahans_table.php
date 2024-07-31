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
        Schema::create('bahans', function (Blueprint $table) {
            $table->id('bahan_id');
            $table->foreignId('supplier_id')->references('supplier_id')->on('suppliers');
            $table->string('nama_bahan');
            $table->string('slug')->unique();
            $table->unsignedInteger('stock');
            $table->unsignedInteger('harga_bahan_per_satuan');
            $table->unsignedInteger('harga_bahan_keseluruhan');
            $table->string('satuan_bahan');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bahans');
    }
};

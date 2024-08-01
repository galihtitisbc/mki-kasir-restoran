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
        Schema::create('stocks', function (Blueprint $table) {
            $table->id('stock_id');
            $table->enum('shift', ['SIANG', 'MALAM']);
            $table->foreignId('bahan_id')->references('bahan_id')->on('bahans');
            $table->unsignedInteger('stock_awal')->nullable();
            $table->unsignedInteger('stock_masuk')->nullable();
            $table->unsignedInteger('stock_keluar')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};

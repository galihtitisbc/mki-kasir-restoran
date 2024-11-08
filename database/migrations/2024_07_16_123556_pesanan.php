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
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id('pesanan_id');
            $table->foreignId('meja_id')->nullable()->references('meja_id')->on('mejas');
            $table->foreignId('outlet_id')->nullable()->references('outlet_id')->on('outlets');
            $table->enum('status', ['UNPAID', 'PAID'])->default('UNPAID');
            $table->string('nama_pemesan')->default('Lorem Ipsum');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanans');
    }
};

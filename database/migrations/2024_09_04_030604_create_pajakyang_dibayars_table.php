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
        Schema::create('pajakyang_dibayars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('history_bayar_pajak_id')->references('id')->on('history_bayar_pajaks');
            $table->string('nama_pajak');
            $table->integer('total');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pajakyang_dibayars');
    }
};

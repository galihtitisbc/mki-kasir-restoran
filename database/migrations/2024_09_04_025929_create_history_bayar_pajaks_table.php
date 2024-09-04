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
        Schema::create('history_bayar_pajaks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('outlet_id')->references('outlet_id')->on('outlets');
            $table->string('untuk_bulan');
            $table->unsignedBigInteger('jumlah_bayar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('history_bayar_pajaks');
    }
};

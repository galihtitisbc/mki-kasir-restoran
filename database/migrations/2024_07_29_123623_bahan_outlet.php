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
        Schema::create('bahan_outlets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bahan_id')->references('bahan_id')->on('bahans');
            $table->foreignId('outlet_id')->references('outlet_id')->on('outlets');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bahan_outlets');
    }
};

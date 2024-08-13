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
        Schema::create('sales_history_taxs', function (Blueprint $table) {
            $table->id('sales_history_tax_id');
            $table->foreignId('sales_history_id')->references('sales_history_id')->on('sales_histories');
            $table->foreignId('tax_id')->references('tax_id')->on('taxs');
            $table->double("total");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_history_taxs');
    }
};

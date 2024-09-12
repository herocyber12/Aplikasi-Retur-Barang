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
        Schema::create('retur_pembelians', function (Blueprint $table) {
            $table->id();
            $table->string('nota_retur_pembelian');
            $table->unsignedBigInteger('retur_id');
            $table->text('alasan_retur');
            $table->string('tindakan')->default('Dikembalikan');
            $table->timestamps();

            $table->foreign('retur_id')->references('id')->on('returs');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('retur_pembelians');
    }
};

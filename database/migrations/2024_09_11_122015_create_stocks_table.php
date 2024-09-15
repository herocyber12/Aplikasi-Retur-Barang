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
            $table->id();
            $table->unsignedBigInteger('produk_id');
            $table->unsignedBigInteger('retur_id')->nullable();
            $table->integer('stok');
            $table->integer('stok_masuk');
            $table->integer('stok_keluar');
            $table->date('tanggal');
            $table->timestamps();

            $table->foreign('produk_id')->references('id')->on('produks');
            $table->foreign('retur_id')->references('id')->on('returs');
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

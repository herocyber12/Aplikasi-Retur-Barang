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
        Schema::create('returs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('produks_id');
            $table->string('supplier');
            $table->string('no_hp_supplier');
            $table->string('alamat_supplier');
            $table->date('tgl_masuk_gudang');
            $table->integer('jumlah_barang');
            $table->enum('kondisi_barang',['Baik','Rusak','Rusak(Sudah Diproses)'])->default('Baik');
            $table->timestamps();

            $table->foreign('produks_id')->references('id')->on('produks');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('returs');
    }
};

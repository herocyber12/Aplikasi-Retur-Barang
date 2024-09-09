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
        Schema::create('pengirimen', function (Blueprint $table) {
            $table->id();
            $table->string('no_resi');
            $table->string('nama_penerima');
            $table->string('alamat_penerima');
            $table->string('no_hp_penerima');
            $table->date('batas_kirim');
            $table->enum('kondisi_barang',['Baik','Rusak']);
            $table->enum('status_pengiriman',['Sedang Dikirim','Sampai','Transit','Retur','Proses Retur']);
            $table->text('alasan_retur');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengirimen');
    }
};

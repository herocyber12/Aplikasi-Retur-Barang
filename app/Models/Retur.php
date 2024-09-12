<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Retur extends Model
{
    use HasFactory;
    protected $table = "returs";
    protected $guarded = [];

    public function produk()
    {
        return $this->belongsTo(Produk::class,'produks_id');
    }

    public function retur_pembelian()
    {
        return $this->hasMany(ReturPembelian::class,'retur_id');
    }
}

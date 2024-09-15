<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;
    protected $table="stocks";
    protected $guarded = [];

    public function retur()
    {
        return $this->belongsTo(Retur::class,'retur_id');
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class,'produk_id');
    }
}

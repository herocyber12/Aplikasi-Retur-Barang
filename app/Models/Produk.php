<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    protected $table = 'produks';
    protected $guarded = [];

    public function stok()
    {
        return $this->hasMany(Stock::class,'produk_id');
    }

    public function retur()
    {
        return $this->hasMany(Retur::class,'produks_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturPembelian extends Model
{
    use HasFactory;
    protected $table = 'retur_pembelians';
    protected $guarded = [];

    public function retur()
    {
        return $this->belongsTo(Retur::class,'retur_id');
    }
}

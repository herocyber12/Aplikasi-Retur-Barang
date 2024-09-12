<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $table='roles';
    protected $guarded = [];

    public function users_role()
    {
        return $this->hasMany(User::class,'id_role');
    }
}

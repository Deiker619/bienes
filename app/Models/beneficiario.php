<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\retiro;

class beneficiario extends Model
{
    use HasFactory;
    protected $fillable = ['nombre', 'cedula','apellido', 'telefono'];

    public function retiros()
    {
        return $this->hasMany(retiro::class, 'beneficiario_id');
    }
}

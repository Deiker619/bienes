<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\retiro;

class jornada extends Model
{
    use HasFactory;
    protected $fillable = ['descripcion', 'fecha'];
    public function retiros()
    {
        return $this->hasMany(retiro::class, 'jornada_id');
    }
}

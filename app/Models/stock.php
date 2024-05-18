<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class stock extends Model
{
    use HasFactory;
    protected $fillable = ['artificio_id','cantidad_artificio'];

     // Definir la relación con el modelo User
     public function artificio()
     {
         return $this->belongsTo(artificio::class, 'artificio_id');
     }
}

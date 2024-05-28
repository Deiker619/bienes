<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class retiro extends Model
{
    use HasFactory;
    protected $fillable = ['artificio_id', 'cantidad_retirada', 'lugar_destino'];

    public function artificio()
    {
        return $this->belongsTo(artificio::class, 'artificio_id');
    }
    public function coordinacion()
    {
        return $this->belongsTo(coordinacion::class, 'lugar_destino');
    }
}

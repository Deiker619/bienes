<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class retiro extends Model
{
    use HasFactory;
    protected $fillable = ['artificio_id', 'cantidad_retirada', 'lugar_destino', 'beneficiario_id','jornada_id', 'ente_id'];

    public function artificio()
    {
        return $this->belongsTo(artificio::class, 'artificio_id');
    }
    public function coordinacion()
    {
        return $this->belongsTo(coordinacion::class, 'lugar_destino');
    }
    public function beneficiario()
    {
        return $this->belongsTo(beneficiario::class, 'beneficiario_id');
    }
    public function jornada()
    {
        return $this->belongsTo(jornada::class, 'jornada_id');
    }
    public function ente()
    {
        return $this->belongsTo(ente::class, 'ente_id');
    }
}

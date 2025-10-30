<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class retiro extends Model
{
    use HasFactory;
    protected $fillable = ['observacion','cedula_tercero', 'nombre_tercero' ,'lugar_destino', 'beneficiario_id','jornada_id', 'ente_id','nombre_entrega','cedula_entrega'];

 
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
    public function retiro_artificios(){
        return $this->hasMany(Retiro_artificio::class, 'retiro_id');
    }
}

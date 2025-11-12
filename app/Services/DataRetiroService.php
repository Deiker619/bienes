<?php

namespace App\Services;

use App\Models\retiro;


class DataRetiroService
{
    public function DataPdfWithNota($retiro, $option='all')
    {

        $data = retiro::query()
            ->with([
                'retiro_artificios' => function ($query) {
                    $query->select('id', 'artificio_id', 'retiro_id', 'cantidad', 'created_at')
                        ->with([
                            'artificio:id,name'
                        ]);
                },
            ])
            ->select('id', 'lugar_destino', 'observacion', 'nombre_tercero', 'cedula_tercero','nombre_entrega','cedula_entrega', 'beneficiario_id', 'jornada_id', 'ente_id', 'created_at')
            ->where('id', $retiro)
            ->with([
                'beneficiario:id,nombre,cedula',
                'jornada:id,descripcion',
                'coordinacion:id,name_coordinacion',
                'ente:id,descripcion'
            ])
            
            ->first();
        return $data;
    }


    public function allRetiros(){
        $data = retiro::query()
            ->with([
                'retiro_artificios' => function ($query) {
                    $query->select('id', 'artificio_id', 'retiro_id', 'cantidad', 'created_at')
                        ->with([
                            'artificio:id,name'
                        ]);
                },
            ])
            ->select('id', 'lugar_destino', 'observacion', 'nombre_tercero', 'cedula_tercero','nombre_entrega','cedula_entrega', 'beneficiario_id', 'jornada_id', 'ente_id', 'created_at')
            ->with([
                'beneficiario:id,nombre,cedula',
                'jornada:id,descripcion',
                'coordinacion:id,name_coordinacion',
                'ente:id,descripcion'
            ])
            
            ->get();
        return $data;
    }
}

<?php

namespace App\Services;

use App\Models\beneficiario;
use App\Models\jornada;
use App\Models\retiro;
use App\Models\stock;
use Illuminate\Support\Facades\DB;

class RetiroService
{
    
    public function deleteRetiro($id)
    {
        $retiro = retiro::find($id);
        if ($retiro) {
            $retiro->delete();
            return true;
        } else {
            return false;
        }
    }
    public function exportRetiroWithNote($id)
    {
        redirect()->route('pdf_with_nota', ['id' => $id]);
    }


    public function artificiosDisponibles($id)
    {
        $consulta = stock::select('cantidad_artificio')
            ->where('artificio_id', $id)
            ->first(); // Obtener solo el primer resultado
        if ($consulta) {
            return $consulta->cantidad_artificio;
        } else {
            return 0; // O cualquier otro valor predeterminado si no hay resultados
        }
    }

    public function add_beneficiario($cedula, $nombre)
    {

        $beneficiario = beneficiario::where('cedula', $cedula)->first();

        if ($beneficiario) {
            return $beneficiario->id;
        } else {
            $create_beneficiario = beneficiario::create([
                'nombre' => $nombre,
                'cedula' => $cedula,

            ]);
            return $create_beneficiario->id;
        }
    }
    public function add_jornada($fecha, $descripcion)
    {

        $create_jornada = jornada::create([
            'descripcion' => $descripcion,
            'fecha' => $fecha,

        ]);
        return $create_jornada->id;
    }
    public function retiro()
    {
       
    }
}

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
    /* public function retiro() {
        try {
           
            $this->restante =  (int)$this->cantidad - (int)$this->retiro_cantidad;
            if ($this->restante < 0) {
                $this->dispatch('error', "Stock insuficiente para la cantidad solicitada");
            }
            if ($this->restante >= 0) {


                switch ($this->destino) {
            
                    case 'beneficiario_retiro':
                        $beneficiario =  $this->add_beneficiario($this->beneficiario_cedula, $this->beneficiario_nombre);
                        $add_retiro = retiro::create([
                            'artificio_id' => $this->artificio_retiro,
                            'cantidad_retirada' => $this->retiro_cantidad,
                            'beneficiario_id' => $beneficiario,
                            'observacion' => $this->observacion,
                            'nombre_tercero' => $this->nombre_tercero,
                            'cedula_tercero' => $this->cedula_tercero
                        ]);
                        break;
                    case 'coordinacion_retiro':
           
                        $add_retiro = retiro::create([
                            'artificio_id' => $this->artificio_retiro,
                            'cantidad_retirada' => $this->retiro_cantidad,
                            'lugar_destino' => $this->coordinacion_retiro,
                            'observacion' => $this->observacion,
                            'nombre_tercero' => $this->nombre_tercero,
                            'cedula_tercero' => $this->cedula_tercero
                        ]);
                        break;
                    case 'jornada_retiro':
                 
                        $jornada =  $this->add_jornada($this->jornada_fecha, $this->jornada_descripcion);
                        $add_retiro = retiro::create([
                            'artificio_id' => $this->artificio_retiro,
                            'cantidad_retirada' => $this->retiro_cantidad,
                            'jornada_id' => $jornada,
                            'observacion' => $this->observacion,
                            'nombre_tercero' => $this->nombre_tercero,
                            'cedula_tercero' => $this->cedula_tercero
                        ]);
                        break;

                    default:
                        # code...
                        break;
                }



                if ($add_retiro) {
         
                    $stock = stock::where('artificio_id', $this->artificio_retiro)->first();
                    $stock->cantidad_artificio = $this->restante; //Actualizamos la cantidad restante del stock
                    $stock->save(); 
                    $this->dispatch('artificioAdded', 'Retiro exitoso, quedan ' . $this->restante . ' disponible');
                    $this->reset([
                        'artificio_retiro',
                        'retiro_cantidad',
                        'coordinacion_retiro',
                        'cantidad',
                        'restante',
                        'beneficiario_cedula',
                        'beneficiario_nombre',
                        'jornada_fecha',
                        'jornada_descripcion',
                        'descripcion',
                        'observacion',
                        'nombre_tercero',
                        'cedula_tercero',
                        'destino'
                    ]);
                } else {
                    $this->dispatch('error', "Se produjo un error en la transacción");
                    DB::rollback();
                }
                DB::commit();
            }
        } catch (\Throwable $th) {
            $this->dispatch('error', "Ha ocurrido un error inesperado");
            DB::rollback();
        }
    } */
}

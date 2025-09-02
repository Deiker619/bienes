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
    public function retiro($artificiosRetiro, $destino) {
        try {
            // Iniciar transacción si es necesario
            DB::beginTransaction();
            // Recorrer todos los artificios del retiro
            foreach ($artificiosRetiro as $artificio) {
                $restante = (int)$artificio['cantidad'] - (int)$artificio["retiro_cantidad"];
                
                if ($restante < 0) {
                    // Usar excepción en lugar de dd() para manejo profesional de errores
                    throw new \Exception('Stock insuficiente para la cantidad solicitada en el artificio: ' . ($artificio['nombre'] ?? ''));
                }
                
                // Procesar según el destino
                switch ($destino['destino']) {
                    case "beneficiario_retiro":
                        $this->procesarBeneficiario($artificio, $destino, $restante);
                        break;
                        
                    case 'coordinacion_retiro':
                        $this->procesarCoordinacion($artificio, $destino, $restante);
                        break;
                        
                    case 'jornada_retiro':
                        $this->procesarJornada($artificio, $destino, $restante);
                        break;
    
                    default:
                        throw new \Exception('Destino no válido: ' . $destino['destino']);
                }
                
            }
            
            // Confirmar transacción si todo fue exitoso
            DB::commit();
            
            // Éxito
            // $this->dispatch('artificioAdded', 'Retiro exitoso');
            
        } catch (\Exception $e) {
            // Revertir transacción en caso de error
            DB::rollback();
            // Manejar error
            // $this->dispatch('error', $e->getMessage());
            
            // Para depuración
            dd('Error: ' . $e->getMessage(), $artificiosRetiro);
        }
    }
    
    // Métodos auxiliares para cada tipo de destino
    protected function procesarBeneficiario($artificio, $destino, $restante) {
        // Lógica para beneficiario
        $beneficiario = $this->add_beneficiario(
            $destino['beneficiario']['beneficiario_cedula'] ?? null, 
            $destino['beneficiario']['beneficiario_nombre'] ?? null
        );
        if($beneficiario){
            //dd($artificio, $destino, $restante );
           $addRetiro = $this->addRetiro($artificio, $destino, $beneficiario, $restante);
            
        };

    }
    public function addRetiro($artificio, $destino, $beneficiario,$restante){
        $isRetiro = retiro::create([
            'artificio_id' => $artificio['artificio_retiro'],
            'cantidad_retirada' => $artificio['retiro_cantidad'],
            'beneficiario_id' => $beneficiario,
            'observacion' => $destino['observacion'] ?? null,
            'nombre_tercero' => $destino['nombre_tercero'] ?? null,
            'cedula_tercero' => $destino['cedula_tercero'] ?? null
        ]);
        $this->actualizarStock($artificio['artificio_retiro'], $restante);
    }
    
    protected function procesarCoordinacion($artificio, $destino, $restante) {
        // Lógica para coordinación
        /* $add_retiro = retiro::create([
            'artificio_id' => $artificio['artificio_id'],
            'cantidad_retirada' => $artificio['retiro_cantidad'],
            'lugar_destino' => $destino['coordinacion_retiro'] ?? null,
            'observacion' => $destino['observacion'] ?? null,
            'nombre_tercero' => $destino['nombre_tercero'] ?? null,
            'cedula_tercero' => $destino['cedula_tercero'] ?? null
        ]); */
        
        // Para depuración
        dd('Procesando coordinación', $artificio, $destino, $restante);
    }
    
    protected function procesarJornada($artificio, $destino, $restante) {
        // Lógica para jornada
        $jornada = $this->add_jornada(
            $destino['jornada_fecha'] ?? null, 
            $destino['jornada_descripcion'] ?? null
        );
        
        /* $add_retiro = retiro::create([
            'artificio_id' => $artificio['artificio_id'],
            'cantidad_retirada' => $artificio['retiro_cantidad'],
            'jornada_id' => $jornada,
            'observacion' => $destino['observacion'] ?? null,
            'nombre_tercero' => $destino['nombre_tercero'] ?? null,
            'cedula_tercero' => $destino['cedula_tercero'] ?? null
        ]); */
        
        // Para depuración
        dd('Procesando jornada', $artificio, $destino, $restante);
    }
    
    // Método para actualizar stock (ejemplo)
    public function actualizarStock($artificioId, $nuevaCantidad) {
        $stock = stock::where('artificio_id', $artificioId)->first();
        if ($stock) {
            $stock->cantidad_artificio = $nuevaCantidad;
            $stock->save();
        }
    }
    
}

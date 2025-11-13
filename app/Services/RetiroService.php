<?php

namespace App\Services;

use App\Models\Artificio;
use App\Models\beneficiario;
use App\Models\jornada;
use App\Models\retiro;
use App\Models\Retiro_artificio;
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
    public function dataArtificio($id)
    {
        return Artificio::findOrFail($id);
    }

    public function createRetiro($destino)
    {

        $data = [
            'observacion' => $destino['observacion'] ?? null,
            'nombre_tercero' => $destino['nombre_tercero'] ?? null,
            'cedula_tercero' => $destino['cedula_tercero'] ?? null,
            'nombre_entrega' => $destino['entrega']['nombre_entrega'] ?? null,
            'cedula_entrega' => $destino['entrega']['cedula_entrega'] ?? null,
        ];

        // Detecta el tipo de destino para asignar el ID correcto
        switch ($destino['destino']) {
            case 'beneficiario_retiro':
                $entidadId = $this->add_beneficiario(
                    $destino['beneficiario']['beneficiario_cedula'] ?? null,
                    $destino['beneficiario']['beneficiario_nombre'] ?? null
                );
                $data['beneficiario_id'] = $entidadId;
                break;
            case 'coordinacion_retiro':
                $data['lugar_destino'] = $destino['coordinacion'];
                break;
            case 'jornada_retiro':
                $entidadId = $this->add_jornada(
                    $destino['jornada']['jornada_fecha'] ?? null,
                    $destino['jornada']['jornada_descripcion'] ?? null
                );
                $data['jornada_id'] = $entidadId;
                break;
            default:
                throw new \Exception("Destino no válido: {$destino['destino']}");
        }

        return $isRetiro = retiro::create($data);
    }
    public function retiro($artificiosRetiro, $destino)
    {

        $data = [];

        try {
            // Iniciar transacción si es necesario
            DB::beginTransaction();
            $retiro = $this->createRetiro($destino);

            foreach ($artificiosRetiro as $artificio) {
                $restante = (int)$artificio['cantidad'] - (int)$artificio["retiro_cantidad"];

                if ($restante < 0) {
                    // Usar excepción en lugar de dd() para manejo profesional de errores
                    $artificioInsuficiente = $this->dataArtificio($artificio['artificio_retiro']);
                    throw new \Exception('Stock insuficiente para el artificio: ' . ($artificioInsuficiente['name'] ?? ''));
                }

                // Procesar según el destino
                array_push($data, Retiro_artificio::create([
                    'artificio_id' => $artificio['artificio_retiro'],
                    'cantidad' => $artificio["retiro_cantidad"],
                    'retiro_id' => $retiro->id
                ]));
                $this->actualizarStock($artificio['artificio_retiro'], $restante);
            }

            // Confirmar transacción si todo fue exitoso
            DB::commit();
            $data = [
                'retiro' => $retiro,
                'data' => $data
            ];
            return $data;
        } catch (\Exception $e) {
            // Revertir transacción en caso de error
            DB::rollback();
            return $e->getMessage();
        }
    }




    // Método para actualizar stock (ejemplo)
    public function actualizarStock($artificioId, $nuevaCantidad)
    {
        $stock = stock::where('artificio_id', $artificioId)->first();
        if ($stock) {
            $stock->cantidad_artificio = $nuevaCantidad;
            $stock->save();
        }
    }
}

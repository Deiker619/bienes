<?php

namespace App\Services;

use App\Models\artificio;
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
    public function dataArtificio($id)
    {
        return artificio::findOrFail($id);
    }
    public function retiro($artificiosRetiro, $destino)
    {
        try {
            // Iniciar transacción si es necesario
            DB::beginTransaction();
            // Recorrer todos los artificios del retiro
            foreach ($artificiosRetiro as $artificio) {
                $restante = (int)$artificio['cantidad'] - (int)$artificio["retiro_cantidad"];

                if ($restante < 0) {
                    // Usar excepción en lugar de dd() para manejo profesional de errores
                    $artificioInsuficiente = $this->dataArtificio($artificio['artificio_retiro']);
                    throw new \Exception('Stock insuficiente para el artificio: ' . ($artificioInsuficiente['name'] ?? ''));
                }

                // Procesar según el destino
                switch ($destino['destino']) {
                    case "beneficiario_retiro":
                        $data =  $this->procesarBeneficiario($artificio, $destino, $restante);
                        break;

                    case 'coordinacion_retiro':
                        $data = $this->procesarCoordinacion($artificio, $destino, $restante);

                        break;

                    case 'jornada_retiro':
                        $data = $this->procesarJornada($artificio, $destino, $restante);
                        break;

                    default:
                        throw new \Exception('Destino no válido: ' . $destino['destino']);
                }
            }

            // Confirmar transacción si todo fue exitoso
            DB::commit();
            // Éxito
            return $data;
        } catch (\Exception $e) {
            // Revertir transacción en caso de error
            DB::rollback();
            return $e->getMessage();
        }
    }


    public function addRetiro($artificio, $destino, $entidadId, $restante)
    {
        // Debug temporal
        // dd($artificio, $destino, $entidadId, $restante);

        $data = [
            'artificio_id' => $artificio['artificio_retiro'],
            'cantidad_retirada' => $artificio['retiro_cantidad'],
            'observacion' => $destino['observacion'] ?? null,
            'nombre_tercero' => $destino['nombre_tercero'] ?? null,
            'cedula_tercero' => $destino['cedula_tercero'] ?? null,
        ];

        // Detecta el tipo de destino para asignar el ID correcto
        switch ($destino['destino']) {
            case 'beneficiario_retiro':
                $data['beneficiario_id'] = $entidadId;
                break;
            case 'coordinacion_retiro':
                $data['lugar_destino'] = $entidadId;
                break;
            case 'jornada_retiro':
                $data['jornada_id'] = $entidadId;
                break;
            default:
                throw new \Exception("Destino no válido: {$destino['destino']}");
        }

        $isRetiro = retiro::create($data);
        // Actualiza stock
        $this->actualizarStock($artificio['artificio_retiro'], $restante);
        return $isRetiro;
    }

    // Métodos auxiliares para cada tipo de destino
    protected function procesarBeneficiario($artificio, $destino, $restante)
    {
        // Lógica para beneficiario
        $beneficiario = $this->add_beneficiario(
            $destino['beneficiario']['beneficiario_cedula'] ?? null,
            $destino['beneficiario']['beneficiario_nombre'] ?? null
        );
        if ($beneficiario) {
            $addRetiro = $this->addRetiro($artificio, $destino, $beneficiario, $restante);
            return ['beneficiario' => $beneficiario, 'retiro' => $addRetiro];
        };
    }

    protected function procesarCoordinacion($artificio, $destino, $restante)
    {

        $addRetiro = $this->addRetiro($artificio, $destino, $destino['coordinacion'], $restante);
        return ['retiro' => $addRetiro];
    }

    protected function procesarJornada($artificio, $destino, $restante)
    {
        // Lógica para jornada
        $jornada = $this->add_jornada(
            $destino['jornada']['jornada_fecha'] ?? null,
            $destino['jornada']['jornada_descripcion'] ?? null
        );

        if ($jornada) {
            $addRetiro = $this->addRetiro($artificio, $destino, $jornada, $restante);
            return ['jornada' => $jornada, 'retiro' => $addRetiro];
        };

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

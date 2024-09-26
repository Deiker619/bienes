<?php

namespace App\Livewire\Retiro;

use Livewire\Component;
use App\Models\artificio;
use App\Models\beneficiario;
use App\Models\coordinacion;
use App\Models\jornada;
use App\Models\retiro;
use App\Models\stock;
use Illuminate\Support\Facades\DB;

class RetiroFormCreate extends Component
{

    public $retornar;
    public $cantidad = 0, $restante;
    public $retiro_cantidad, $artificio_retiro;
    public $destino;
    public $coordinacion_retiro;

    /* Datos de beneficiario */
    public $beneficiario_cedula, $beneficiario_nombre;
    /* Datos de jornada */
    public $jornada_fecha, $jornada_descripcion;
    /* Datos de ente */
    public $descripcion;

    protected $listeners = ['artificioAdded' => 'artificioAdded'];

    public $rules = [ //Reglas de validaciones generales
        'artificio_retiro' => 'required',
        'cantidad' => 'required',
        'retiro_cantidad' => 'required|numeric',
        'destino' => 'required'

    ];

    public function updated($propertyName)
    { //Funcion para que se actualice en vivo las reglas de validacion cada vez que se corrija un input
        $this->validateOnly($propertyName);
    }



    public function render()
    {
        $coordinaciones = coordinacion::select('id', 'name_coordinacion')->get();
        $artificios = artificio::select('id', 'name', 'created_at', 'updated_at')->orderBy('name', 'asc')->get();
        return view('livewire.retiro.retiro-form-create', compact('artificios', 'coordinaciones'));
    }

    public function changeDestino($retiro)
    {
        $this->resetValidation();
        $this->rules = [
            'artificio_retiro' => 'required',
            'cantidad' => 'required',
            'retiro_cantidad' => 'required|numeric',
            'destino' => 'required'

        ];
        //Asigan reglas de validaciones dinamicamente
        switch ($retiro) {
            case 'jornada_retiro':
                $this->rules['jornada_fecha'] = 'required|date';
                $this->rules['jornada_descripcion'] = 'required|string|max:255';
                $this->reset(['beneficiario_cedula', 'beneficiario_nombre']);
                break;
            case 'beneficiario_retiro':
                $this->rules['beneficiario_cedula'] = 'required|numeric';
                $this->rules['beneficiario_nombre'] = 'required|string|max:100|regex:/^[a-zA-ZñÑ\s]+$/u';
                $this->reset(['jornada_fecha', 'jornada_descripcion']);

                break;
            case 'coordinacion_retiro':
                $this->rules['coordinacion_retiro'] = 'required';
                $this->reset(['jornada_fecha', 'jornada_descripcion', 'beneficiario_cedula', 'beneficiario_nombre']);

                break;

            default:
                # code...
                break;
        }
        $this->destino = $retiro;


        /* dd($this->destino, $this->rules); */
    }



    public function artificiosDisponibles($id)
    {
        $consulta = stock::select('cantidad_artificio')
            ->where('artificio_id', $id)
            ->first(); // Obtener solo el primer resultado

        if ($consulta) {
            $this->cantidad = $consulta->cantidad_artificio;
        } else {
            $this->cantidad = 0; // O cualquier otro valor predeterminado si no hay resultados
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
        $this->validate();
        DB::beginTransaction();
        try {
            /* Calculo del registro */
            $this->restante =  (int)$this->cantidad - (int)$this->retiro_cantidad;
            if ($this->restante < 0) {
                $this->dispatch('error', "Stock insuficiente para la cantidad solicitada");
            }
            if ($this->restante >= 0) {


                switch ($this->destino) {
                        /* Agregamos el nuevo retiro */
                    case 'beneficiario_retiro':
                        $beneficiario =  $this->add_beneficiario($this->beneficiario_cedula, $this->beneficiario_nombre);
                        $add_retiro = retiro::create([
                            'artificio_id' => $this->artificio_retiro,
                            'cantidad_retirada' => $this->retiro_cantidad,
                            'beneficiario_id' => $beneficiario
                        ]);
                        break;
                    case 'coordinacion_retiro':
                        /* Agregamos el nuevo retiro */
                        $add_retiro = retiro::create([
                            'artificio_id' => $this->artificio_retiro,
                            'cantidad_retirada' => $this->retiro_cantidad,
                            'lugar_destino' => $this->coordinacion_retiro
                        ]);
                        break;
                    case 'jornada_retiro':
                        /* Agregamos el nuevo retiro */
                        $jornada =  $this->add_jornada($this->jornada_fecha, $this->jornada_descripcion);
                        $add_retiro = retiro::create([
                            'artificio_id' => $this->artificio_retiro,
                            'cantidad_retirada' => $this->retiro_cantidad,
                            'jornada_id' => $jornada
                        ]);
                        break;

                    default:
                        # code...
                        break;
                }



                if ($add_retiro) { //Si registro se cumple¿?
                    /* Procedemos a modificar el stock */
                    $stock = stock::where('artificio_id', $this->artificio_retiro)->first();
                    $stock->cantidad_artificio = $this->restante; //Actualizamos la cantidad restante del stock
                    $stock->save(); //Guarda cambios
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
                        'descripcion'
                    ]);
                } else {
                    $this->dispatch('error', "Se produjo un error en la transacción");
                    DB::rollback();

                }
                DB::commit();
            }
        } catch (\Throwable $th) {
            //throw $th;
            $this->dispatch('error', "Ha ocurrido un error inesperado");
            DB::rollback();
        }
    }
}

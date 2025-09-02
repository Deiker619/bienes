<?php

namespace App\Livewire\Retiro;

use Livewire\Component;
use App\Models\artificio;
use App\Models\coordinacion;
use App\Models\retiro;
use App\Models\stock;
use App\Services\RetiroService;
use Livewire\Attributes\On;


use Illuminate\Support\Facades\DB;

class RetiroFormCreate extends Component
{
    protected $retiroService;
    public $cargado = false;
    public $cantidad = 0, $restante;

    public $destino;
    public $coordinacion_retiro;
    public $observacion;
    public $recibe_tercero = false;
    public $nombre_tercero;
    public $cedula_tercero;

    /* Datos de beneficiario */
    public $beneficiario_cedula, $beneficiario_nombre;
    public $formBeneficiario =['beneficiario_cedula' => '', 'beneficiario_nombre' => '' ];
    /* Datos de jornada */
    public $jornada_fecha, $jornada_descripcion;
    /* Datos de ente */
    public $descripcion;
    public $artificiosRetiro = [
        ['artificio_retiro' => '', 'cantidad' => '', 'retiro_cantidad' => '']
    ];

    public function addRegistro()
    {
        $this->artificiosRetiro[] = ['artificio_retiro' => '', 'cantidad' => '', 'retiro_cantidad' => ''];
    }

    public function removeRegistro($index)
    {
        unset($this->artificiosRetiro[$index]);
        $this->artificiosRetiro = array_values($this->artificiosRetiro); // reindexar el array
    }

    protected $listeners = ['artificioAdded' => 'artificioAdded'];

    public $rules = [ //Reglas de validaciones generales
        'artificiosRetiro.*.artificio_retiro' => 'required',
        'artificiosRetiro.*.cantidad' => 'required',
        'artificiosRetiro.*.retiro_cantidad' => 'required|numeric',
        'destino' => 'required',
        'observacion' => 'required',
        'recibe_tercero' => 'boolean',
        'nombre_tercero' => 'required_if:recibe_tercero,1',
        'cedula_tercero' => 'required_if:recibe_tercero,1'

    ];



    public function updated($propertyName)
    { //Funcion para que se actualice en vivo las reglas de validacion cada vez que se corrija un input
        $this->validateOnly($propertyName);
    }
    public function boot(RetiroService $retirosService)
    {
        $this->retiroService = $retirosService;
    }


    #[On('artificioAdded')]
    public function render()
    {
        $coordinaciones = coordinacion::select('id', 'name_coordinacion')->get();
        $artificios = artificio::select('id', 'name', 'created_at', 'updated_at')->orderBy('name', 'asc')->get();
        return view('livewire.retiro.retiro-form-create', compact('artificios', 'coordinaciones'));
    }


    public function artificiosDisponibles($id, $index)
    {
        $cantidad = $this->retiroService->artificiosDisponibles($id);
        $this->artificiosRetiro[$index]['cantidad'] = $cantidad;
    }

    public function add_beneficiario($cedula, $nombre)
    {

        return $this->retiroService->add_beneficiario($cedula, $nombre);
    }
    public function add_jornada($fecha, $descripcion)
    {
        return $this->retiroService->add_jornada($fecha, $descripcion);
    }


    public function retiro()
    {
        $this->validate();
        dd($this->artificiosRetiro);
    }
    public function changeRecibeTercero()
    {
        $this->recibe_tercero = !$this->recibe_tercero;
    }
    public function changeDestino($retiro)
    {
        $this->resetValidation();
        $this->rules = $this->rules;
        $this->destino = $retiro;
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
        
    }
}

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
    public $formBeneficiario = ['beneficiario_cedula' => '', 'beneficiario_nombre' => ''];
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

    // En la clase, define reglas base:
    protected $baseRules = [
        'artificiosRetiro.*.artificio_retiro' => 'required',
        'artificiosRetiro.*.cantidad' => 'required',
        'artificiosRetiro.*.retiro_cantidad' => 'required|numeric',
        'destino' => 'required',
        'recibe_tercero' => 'boolean',
        'nombre_tercero' => 'required_if:recibe_tercero,1',
        'cedula_tercero' => 'required_if:recibe_tercero,1'
    ];

    public $rules = [];

    public function mount()
    {
        $this->rules = $this->baseRules;
    }



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

    public function resetPropertys()
    {
        // Reinicia propiedades simples
        $this->reset(
            'cantidad',
            'restante',
            'coordinacion_retiro',
            'observacion',
            'recibe_tercero',
            'rules',
            'nombre_tercero',
            'cedula_tercero',
            'jornada_fecha',
            'jornada_descripcion',
            'descripcion'
        );

        // Reinicia arrays manualmente
        $this->formBeneficiario = ['beneficiario_cedula' => '', 'beneficiario_nombre' => ''];
        $this->artificiosRetiro = [
            ['artificio_retiro' => '', 'cantidad' => '', 'retiro_cantidad' => '']
        ];
    }
    public function retiro()
    {
        $this->validate();
        $destino = [
            'destino' => $this->destino,
            'beneficiario' => $this->formBeneficiario,
            'observacion' => $this->observacion,
            'coordinacion' => $this->coordinacion_retiro,
        ];

        $data =  $this->retiroService->retiro($this->artificiosRetiro, $destino);
        if (isset($data['retiro'])) {
            $this->resetPropertys();
            return  $this->dispatch('artificioAdded', 'Retiro exitoso del stock');
        };
        return $this->dispatch('error', $data);
    }
    public function changeRecibeTercero()
    {
        $this->recibe_tercero = !$this->recibe_tercero;
    }
    public function changeDestino($retiro)
    {
        $this->destino = $retiro;
        $this->resetValidation(); // Limpia errores antiguos
    }

    public function rules()
    {
        // Reglas base, siempre presentes
        $rules = $this->baseRules;

        // Reglas dinámicas dependiendo del destino
        switch ($this->destino) {
            case 'jornada_retiro':
                $rules['jornada_fecha'] = 'required|date';
                $rules['jornada_descripcion'] = 'required|string|max:255';
                break;

            case 'beneficiario_retiro':
                $rules['formBeneficiario.beneficiario_cedula'] = 'required|numeric';
                $rules['formBeneficiario.beneficiario_nombre'] = 'required|string|max:100|regex:/^[a-zA-ZñÑ\s]+$/u';
                break;

            case 'coordinacion_retiro':
                $rules['coordinacion_retiro'] = 'required';
                break;
        }

        return $rules;
    }
}

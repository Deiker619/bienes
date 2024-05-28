<?php

namespace App\Livewire\Retiro;

use Livewire\Component;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\artificio;
use App\Models\coordinacion;
use App\Models\retiro;
use App\Models\stock;
use Livewire\Attributes\On;

class RetiroFormCreate extends Component
{
    public $cantidad = 0, $restante;
    public $retiro_cantidad, $artificio_retiro, $coordinacion_retiro;
    protected $listeners = ['artificioAdded' => 'artificioAdded'];

    public $rules = [
        'coordinacion_retiro' => 'required',
        'artificio_retiro' => 'required',
        'cantidad' => 'required',
        'retiro_cantidad' => 'required'
    ];


    public function render()
    {


        $coordinaciones = coordinacion::select('id', 'name_coordinacion')->get();
        $artificios = artificio::select('id', 'name', 'created_at', 'updated_at')->orderBy('name', 'asc')->get();
        return view('livewire.retiro.retiro-form-create', compact('artificios', 'coordinaciones'));
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

    public function retiro()
    {
        $this->validate();
        $this->restante =  (int)$this->cantidad - (int)$this->retiro_cantidad;
        if ($this->restante < 0) {
            $this->dispatch('error', "Stock insuficiente para la cantidad solicitada");
        }
        if ($this->restante >= 0) {

            /* Agregamos el nuevo retiro */
            $add_retiro = retiro::create([
                'artificio_id' => $this->artificio_retiro,
                'cantidad_retirada' => $this->retiro_cantidad,
                'lugar_destino' => $this->coordinacion_retiro
            ]);

            if ($add_retiro) { //Si registro se cumple¿?
                /* Procedemos a modificar el stock */
                $stock = stock::where('artificio_id', $this->artificio_retiro)->first();
                $stock->cantidad_artificio = $this->restante; //Actualizamos la cantidad restante del stock
                $stock->save(); //Guarda cambios
                $this->dispatch('artificioAdded', 'Retiro exitoso, quedan ' . $this->restante . ' disponible');
                $this->reset(['artificio_retiro', 'retiro_cantidad', 'coordinacion_retiro', 'cantidad', 'restante']);
            }
        }
    }
}

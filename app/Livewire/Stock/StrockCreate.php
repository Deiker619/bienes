<?php

namespace App\Livewire\Stock;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\stock;
use App\Models\artificio;
use Livewire\Attributes\On;

class StrockCreate extends Component
{
    public $open_modal = false;
    public $id, $cantidad;

    public $rules = [
        'id' => 'required',
        'cantidad' => 'required'
    ];

    #[Layout('layouts.app')] //EVITA PROBLEMAS CON LA PLANTILLA */
    public function render()
    {
        $artificios = artificio::select('id', 'name')->orderBy('name', 'asc')->get();

        return view('livewire.stock.strock-create', compact('artificios'));
    }


    public function store()
    {

        $this->validate();
        $verify = stock::where('artificio_id', $this->id)->first();
        if ($verify) {
            $verify->cantidad_artificio = $verify->cantidad_artificio + $this->cantidad;
            /* Guarda los cambios */
            $verify->save();
            /* Emite un mensaje para la alerta del SweetAlert */
            $this->dispatch('artificioAdded', 'Se añadieron +'.$this->cantidad.' de este artificio');
        }

        if (!$verify) {
            /* Crea el nuevo registro */
            stock::create([
                'artificio_id' => $this->id,
                'cantidad_artificio' => $this->cantidad
            ]);
            
            $this->dispatch('artificioAdded', 'Se agregó correctamente');
        }
        /* Resetea las variables */
        $this->reset(['id', 'cantidad']);
        /* Cierra el modal */
        $this->open_modal = false;
    }
}

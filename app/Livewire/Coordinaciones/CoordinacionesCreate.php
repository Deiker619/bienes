<?php

namespace App\Livewire\Coordinaciones;

use Livewire\Component;
use App\Models\coordinacion;
use Livewire\Attributes\On;

class CoordinacionesCreate extends Component
{
    public $open_modal, $name_coordinacion, $id;
    
    public function render()
    {
        return view('livewire.coordinaciones.coordinaciones-create');
    }

    public function store(){
        $add_coordinacion = coordinacion::create([
            'name_coordinacion' => ucwords($this->name_coordinacion) //Guardar en mayuscula
        ]);

        if($add_coordinacion){
            $this->dispatch('artificioAdded', 'Se registró  '.$this->name_coordinacion  );
            $this->reset(['name_coordinacion']);
        }
    }
}

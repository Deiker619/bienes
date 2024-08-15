<?php

namespace App\Livewire\Coordinaciones;

use Livewire\Component;
use App\Models\coordinacion;


class CoordinacionesCreate extends Component
{
    public $open_modal, $name_coordinacion, $id;
    public $rules = ['name_coordinacion'=>'required|string'];

    public function updated($propertyName){
        $this->validateOnly($propertyName);
    }
    public function render()
    {
        return view('livewire.coordinaciones.coordinaciones-create');
    }

    public function store(){
        $this->validate();
        $add_coordinacion = coordinacion::create([
            'name_coordinacion' => ucwords($this->name_coordinacion) //Guardar en mayuscula
        ]);

        if($add_coordinacion){
            $this->dispatch('artificioAdded', 'Se registró  '.$this->name_coordinacion  );
            $this->reset(['name_coordinacion']);
        }
    }
}

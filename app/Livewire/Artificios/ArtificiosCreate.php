<?php

namespace App\Livewire\Artificios;

use Livewire\Component;
use App\Models\artificio;

class ArtificiosCreate extends Component
{
    public $open_modal = false;
    public $name;
    public $tipo_restriccion = 'none';

    public $rules=['name'=>'required|string', 'tipo_restriccion'=>'required|in:none,monthly,once']; 
    public function updated($propertyName){
        $this->validateOnly($propertyName);
    }
    public function render()
    {
        return view('livewire.artificios.artificios-create');
    }

    public function store(){
        $this->validate();
       $add_artificio =  artificio::create([
            'name'=> $this->name,
            'tipo_restriccion' => $this->tipo_restriccion
        ]);
        if($add_artificio){
            $this->dispatch('artificioAdded', 'Se registró un/a '.$this->name );
        }

        $this->reset(['name', 'tipo_restriccion']);
        $this->open_modal = false;

    }

}

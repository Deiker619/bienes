<?php

namespace App\Livewire\Artificios;

use Livewire\Component;
use App\Models\artificio;

class ArtificiosCreate extends Component
{
    public $open_modal = false;
    public $name;

    public $rules=['name'=>'required|string|regex:/^[a-zA-ZñÑ\s]+$/u'];
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
            'name'=> $this->name
        ]);
        if($add_artificio){
            $this->dispatch('artificioAdded', 'Se registró un/a '.$this->name );
        }

        $this->reset(['name']);
        $this->open_modal = false;

    }

}

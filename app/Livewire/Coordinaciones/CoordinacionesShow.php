<?php

namespace App\Livewire\Coordinaciones;

use Livewire\Component;
use App\Models\coordinacion;
use Livewire\Attributes\On;


class CoordinacionesShow extends Component
{

    public $name_coordinacion, $id, $open_edit;

    protected $listeners = ['artificioAdded' => 'artificioAdded'];
    #[On('artificioAdded')]
    public function render()
    {
        $coordinaciones = coordinacion::select('id','name_coordinacion')->get();
        return view('livewire.coordinaciones.coordinaciones-show', compact('coordinaciones'));
    }

    public function edit($id)
    {

        $this->open_edit = true;
        $registro = coordinacion::findOrfail($id);
        
        $this->name_coordinacion = $registro->name_coordinacion;
        $this->id = $registro->id;
        
    }

    public function update()
    {
        $this->name_coordinacion = ucwords($this->name_coordinacion);
        $registro = coordinacion::find($this->id);
        $registro->fill($this->all());
        $registro->save();


        $this->open_edit = false;
        $this->dispatch('artificioAdded', 'Se modificó esta coordinacion');
    }

    public function delete($id)
    {
        
        $registro = coordinacion::findOrFail($id);
        $registro->delete();

        $this->dispatch('artificioAdded', 'Coordinación eliminada');
       
    }
}

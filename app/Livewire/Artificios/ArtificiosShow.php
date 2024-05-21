<?php

namespace App\Livewire\Artificios;

use Livewire\Component;
use App\Models\artificio;
use Livewire\Attributes\On;


class ArtificiosShow extends Component
{
    public $open_edit, $name, $id;
    protected $listeners = ['artificioAdded' => 'artificioAdded'];

    #[On('artificioAdded')]
    public function render()
    {
        $artificios = artificio::select('id', 'name', 'created_at', 'updated_at')->orderBy('name', 'asc')->get();
        return view('livewire.artificios.artificios-show', compact('artificios'));
    }




    public function edit($id)
    {
        $this->open_edit = true;
        $registro = artificio::findOrfail($id);

        $this->name = $registro->name;
        $this->id = $registro->id;
    }


    public function update()
    {
        
        $registro = artificio::find($this->id);
        $registro->fill($this->all());
        $registro->save();

        $this->open_edit = false;
        $this->dispatch('artificioAdded', 'Se modificó este artificio');
    }

    public function delete($id)
    {
        
        $registro = artificio::findOrFail($id);
        $registro->delete();

        $this->dispatch('artificioAdded', 'Artificio eliminado');
       
    }
}

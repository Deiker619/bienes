<?php

namespace App\Livewire\Artificios;

use Livewire\Component;
use App\Models\Artificio;
use Livewire\Attributes\On;
use Livewire\WithPagination;

class ArtificiosShow extends Component
{
    use WithPagination;
    public $open_edit, $name, $id;
    protected $listeners = ['artificioAdded' => 'artificioAdded'];

    #[On('artificioAdded')]
    public function render()
    {
        $artificios = Artificio::select('id', 'name', 'created_at', 'updated_at')->orderBy('name', 'asc')->paginate(10);
        return view('livewire.artificios.artificios-show', compact('artificios'));
    }




    public function edit($id)
    {
        $this->open_edit = true;
        $registro = Artificio::findOrfail($id);

        $this->name = $registro->name;
        $this->id = $registro->id;
    }


    public function update()
    {
        
        $registro = Artificio::find($this->id);
        $registro->fill($this->all());
        $registro->save();

        $this->open_edit = false;
        $this->dispatch('artificioAdded', 'Se modificó este artificio');
    }

    public function delete($id)
    {
        
        $registro = Artificio::findOrFail($id);
        $registro->delete();

        $this->dispatch('artificioAdded', 'Artificio eliminado');
       
    }
}

<?php

namespace App\Livewire\Retiro;

use Livewire\Component;
use App\Models\artificio;
use App\Models\stock;

class RetiroFormCreate extends Component
{
    public $cantidad = 0;
    public function render()
    {



        $artificios = artificio::select('id', 'name', 'created_at', 'updated_at')->orderBy('name', 'asc')->get();
        return view('livewire.retiro.retiro-form-create', compact('artificios'));
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
}

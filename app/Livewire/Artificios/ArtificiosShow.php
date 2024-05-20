<?php

namespace App\Livewire\Artificios;

use Livewire\Component;
use App\Models\artificio;

class ArtificiosShow extends Component
{
    public function render()
    {
        $artificios = artificio::select('id', 'name', 'created_at', 'updated_at')->orderBy('name', 'asc')->get();
        return view('livewire.artificios.artificios-show', compact('artificios'));
    }
}

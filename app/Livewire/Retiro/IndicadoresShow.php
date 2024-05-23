<?php

namespace App\Livewire\Retiro;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\coordinacion;
use App\Models\retiro;
use App\Models\artificio;
use App\Models\stock;

class IndicadoresShow extends Component
{
    protected $listeners = ['artificioAdded' => 'artificioAdded'];
    #[On('artificioAdded')]
    public function render()
    {
        $total_artificio = stock::sum('cantidad_artificio');
        $tipos_artificio = artificio::count();
        $total_retiros = retiro::count();
        return view('livewire.retiro.indicadores-show', compact('total_artificio', 'tipos_artificio', 'total_retiros'));
    }
    
}

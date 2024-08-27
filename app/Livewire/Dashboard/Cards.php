<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Models\artificio;
use App\Models\coordinacion;
use App\Models\retiro;
use App\Models\stock;

class Cards extends Component
{
    public function render()
    {
        $total_artificio = stock::sum('cantidad_artificio');
        $tipos_artificio = artificio::count();
        $total_retiros = retiro::count();
        $total_coordinaciones = coordinacion::count();
        return view('livewire.dashboard.cards', compact(
            ['total_artificio', 'tipos_artificio', 
            'total_retiros', 'total_coordinaciones']
            )
        );
    }
}

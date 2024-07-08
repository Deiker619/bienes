<?php

namespace App\Livewire\Retiro;
use App\Models\retiro;
use Livewire\Attributes\On;
use Livewire\Component;

class RetiroHistorial extends Component
{

   protected $listeners = ['artificioAdded' => 'artificioAdded'];

    #[On('artificioAdded')]
    public function render()
    {
        $retiros = retiro::with('coordinacion:id,name_coordinacion', 'artificio:id,name')
            ->select('id','artificio_id','lugar_destino','beneficiario_id', 'jornada_id', 'ente_id',
            'cantidad_retirada','created_at')
            ->limit(3)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('livewire.retiro.retiro-historial', compact('retiros'));
    }

}

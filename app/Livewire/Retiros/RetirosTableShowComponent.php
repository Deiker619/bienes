<?php

namespace App\Livewire\Retiros;

use Livewire\Component;
use App\Models\retiro;
use Livewire\Attributes\On;



class RetirosTableShowComponent extends Component
{
    public function render()
    {
        $retiros = retiro::select('id', 'artificio_id', 'cantidad_retirada', 'lugar_destino', 'created_at')->orderby('created_at', 'desc')->get();
        return view('livewire.retiros.retiros-table-show-component', compact('retiros'));
    }
}

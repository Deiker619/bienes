<?php

namespace App\Livewire\Retiro;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\retiro;

class RetirosTableShow extends Component
{

    
    public function render()
    {

        return view('livewire.retiro.retiros-table-show', compact('retiros'));
    }
}

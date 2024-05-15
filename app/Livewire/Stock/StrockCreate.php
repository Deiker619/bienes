<?php

namespace App\Livewire\Stock;

use Livewire\Component;

class StrockCreate extends Component
{
    public $open_modal = false;
    public function render()
    {
        return view('livewire.stock.strock-create');
    }
}

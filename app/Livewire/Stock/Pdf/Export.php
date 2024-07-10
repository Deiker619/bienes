<?php

namespace App\Livewire\Stock\Pdf;

use Livewire\Component;

class Export extends Component
{
    public function render()
    {
        return view('livewire.stock.pdf.export');
    }

    public function export(){
        redirect()->route('exportStock');
    }
}

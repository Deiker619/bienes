<?php

namespace App\Livewire\Retiro\Pdf;

use Livewire\Component;


class RetirosExport extends Component
{
    public function render()
    {
        return view('livewire.retiro.pdf.retiros-export');
    }

    public function export(){
        redirect()->route('exportAllRetiros');
    }
}
